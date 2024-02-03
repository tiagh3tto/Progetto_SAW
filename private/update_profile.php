<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    else{
        header('Content-Type: application/json');

        $body = file_get_contents('php://input');
        $data = json_decode($body);
        $email = $_SESSION['email'];

        $nome = htmlspecialchars(trim($data->Nome));
        $cognome = htmlspecialchars(trim($data->Cognome));
        $data_nascita = htmlspecialchars(trim($data->Data_Nascita));
        $paese = htmlspecialchars(trim($data->Nazionalità));


        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
            $query = "UPDATE Utenti SET Nome = ?, Cognome = ?, Data_Nascita = ?, Genere = ?, Nazionalità = ? WHERE Email = ?;";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $cognome, $data_nascita, $data->Genere, $paese, $email);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            echo json_encode($data);
        }
        catch(mysqli_sql_exception $e){
            echo "Errore Interno";                              //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        }    
    }    
?>