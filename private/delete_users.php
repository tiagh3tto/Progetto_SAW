<?php
if(!isset($_SESSION)) 
session_start(); 
if(!isset($_SESSION["admin"]) && !$_SESSION["admin"] )
header('Location: /SAW/Progetto_SAW/private/login.php');
else{
    // Include your database connection file here
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

    // Get the data from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $selectedUsers = $data['data'];

    try {
        // Prepare an SQL statement for updating the ban field
        $stmt = mysqli_prepare($con, "DELETE FROM film WHERE Nome = ?");

        foreach ($selectedUsers as $user) {
            mysqli_stmt_bind_param($stmt, "s", $user['Nome']);
            mysqli_execute($stmt);
        }

        // Convert the array to JSON
        $result = json_encode(true);


        // Send the updated data back as a JSON response
        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        // If an error occurred, set the response to an error message                                               //OJO: gestire meglio l'errore
        $result = json_encode(['error' => $e->getMessage()]);
        echo $result;
    }
}    
?>