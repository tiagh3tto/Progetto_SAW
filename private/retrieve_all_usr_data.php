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
            $query = "SELECT * FROM utenti";
            $res = mysqli_query($con, $query);
            $data = array();
            while($row = mysqli_fetch_assoc($res)){
                if($row["Admin"] == 0)
                    $data[] = array("Nome"=>$row["Nome"], 
                                    "Cognome"=>$row["Cognome"],
                                    "Email"=>$row["Email"],
                                    "Data_Nascita"=>$row["Data_Nascita"], 
                                    "Genere"=>$row["Genere"], 
                                    "Nazionalità"=>$row["Nazionalità"], 
                                    "Ban"=>$row["Ban"]);
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