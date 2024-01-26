<?php
    if(!isset($_SESSION))
        session_start();
    /*if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');*/
    header('Content-Type: application/json');    
    //se l'utente è admin, carica tutti gli utenti    
    if( isset($_SESSION['admin']) && $_SESSION['admin'] ){
        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
            $query = "SELECT * FROM Utenti";
            $res = mysqli_query($con, $query);
            $data = array();
            while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                $data[] = array("Nome"=>$row[1], "Cognome"=>$row[2], "Email"=>$row[3], "Admin"=>$row[4] , "Data_Nascita"=>$row[6], "Genere"=>$row[7], "Paese"=>$row[8]);
            }
            //return JSON formatted data
            echo(json_encode($data));
            exit;
        }
        catch(mysqli_sql_exception $e){
            echo "Impossibile caricare le tue informazioni";                              //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        }    
    }
    else
        header('Location: /SAW/Progetto_SAW/private/login.php'); //modificare con un alert di errore??
?>