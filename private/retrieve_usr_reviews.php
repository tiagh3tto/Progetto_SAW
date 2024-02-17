<?php
    if(!isset($_SESSION))
        session_start();
    /*if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');*/
    header('Content-Type: application/json');    
    if( isset($_SESSION['ID']) && !empty($_SESSION['ID']) ){
        $ID = $_SESSION['ID'];
        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
            $query = "SELECT * FROM recensioni INNER JOIN film ON recensioni.ID_Film = film.ID WHERE ID_Utente = ? ;";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'i', $ID);
            mysqli_stmt_execute($stmt);
            $res=mysqli_stmt_get_result($stmt);
            
            $count = mysqli_num_rows($res);
        }
        catch(mysqli_sql_exception $e){

            echo "Impossibile caricare le tue informazioni";                              //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
            //header('Location: /SAW/Progetto_SAW/public/unexpected_error.php');
            //exit; 
        }
        //build data array
        if($count != 0){
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                $data[] = [
                "Titolo"=> intval($row["Nome"]),
                "ID"=> intval($row["ID_Film"]),
                "Regia"=> intval($row["Regia"]),
                "Sceneggiatura"=> intval($row["Sceneggiatura"]),
                "Colonna_Sonora"=> intval($row["Colonna_Sonora"]),
                "Recitazione"=> intval($row["Recitazione"]),
                "Fotografia"=> intval($row["Fotografia"])
                ];
            }    
            //return JSON formatted data
            echo json_encode($data);
        }
        else
            echo json_encode(array("Errore"=>"Impossibile caricare le tue recensioni"));
    }  
    else
        header('Location: /SAW/Progetto_SAW/private/login.php'); //modificare con un alert di errore??
?>