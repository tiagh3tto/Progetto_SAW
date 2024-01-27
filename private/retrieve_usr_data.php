<?php
    if(!isset($_SESSION))
        session_start();
    /*if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');*/
    header('Content-Type: application/json');    
    if( isset($_SESSION['email']) && !empty($_SESSION['email']) ){
        $email = $_SESSION['email'];
        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
            $query = "SELECT * FROM Utenti WHERE Email = ?;";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $res=mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res);
        }
        catch(mysqli_sql_exception $e){
            echo "Impossibile caricare le tue informazioni";                              //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        }
        //build data array
        if($count == 1){
            $data = [
            [ "Nome"=>$row["Nome"], "Cognome"=>$row["Cognome"], "Email"=>$row["Email"], "Data_Nascita"=>$row["Data_Nascita"], "Genere"=>$row["Genere"], "Paese"=>$row["Paese"]]
            ];
            //return JSON formatted data
            echo(json_encode($data));
        }
        else
            echo "Impossibile caricare le tue informazioni";
                             //OJO: gestione errori
    }  
    else
        header('Location: /SAW/Progetto_SAW/private/login.php'); //modificare con un alert di errore??
?>