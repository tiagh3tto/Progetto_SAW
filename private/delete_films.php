<?php
if(!isset($_SESSION)) 
    session_start(); 
if(!isset($_SESSION["admin"]) && !$_SESSION["admin"] )
    header('Location: /SAW/Progetto_SAW/private/login.php');
else{
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

    // ottiene il contenuto della richiesta (php://input è uno stream), e fa la decode in un array associativo (true)
    $data = json_decode(file_get_contents('php://input'), true);
    $selectedFilms = $data['data'];

    try {
        $stmt = mysqli_prepare($con, "DELETE FROM film WHERE ID = ?");

        foreach ($selectedFilms as $film) {
            mysqli_stmt_bind_param($stmt, "s", $film['id']);
            mysqli_stmt_execute($stmt);
        }
    } catch (mysqli_sql_exception $e) {
        header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
        exit();
    }
}    
?>