<?php
if(!isset($_SESSION)) 
session_start(); 
if(!isset($_SESSION["admin"]) && !$_SESSION["admin"] )
header('Location: /SAW/Progetto_SAW/private/login.php');
else{
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

    // ottieni il contenuto della richiesta (php://input è uno stream), e fa la decode in un array associativo (true)
    $data = json_decode(file_get_contents('php://input'), true);
    $selectedUsers = $data['data'];

    try {
        $stmt = mysqli_prepare($con, "DELETE FROM utenti WHERE Nome = ?");

        //per ogni utente selezionato esegui la query
        foreach ($selectedUsers as $user) {
            mysqli_stmt_bind_param($stmt, "s", $user['Nome']);
            mysqli_stmt_execute($stmt);
        }

        // Convert the array to JSON
        $result = json_encode(true);

        // Send the updated data back as a JSON response
        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (mysqli_sql_exception $e) {
        // If an error occurred, set the response to an error message                                               //OJO: gestire meglio l'errore
        $result = json_encode(['error' => $e->getMessage()]);
        echo $result;
    }
}    
?>