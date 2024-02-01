<?php
//se viene chiamato get_catalog dalla searchbar
if((isset($_GET["searchBar"]) && isset($_GET["filter"])) && (!empty($_GET["searchBar"]) && !empty($_GET["filter"]))){
    try{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        $allowed_cols = ['Nome', 'Genere', 'Regista', 'Paese', 'Anno', 'Casa_Produzione'];
        $filter = $_GET["filter"];
        if (!in_array($filter, $allowed_cols)) {
            exit('Invalid filter');                         //OJO da gestire errore
        }

        if($filter == "Anno") {
            $_GET["searchBar"] = intval($_GET["searchBar"]); // convert searchBar to integer
            $stmt = mysqli_prepare($con, "SELECT * FROM film WHERE $filter = ?;");
            mysqli_stmt_bind_param($stmt, "i", $_GET["searchBar"]); // bind as integer
        } else {
            $stmt = mysqli_prepare($con, "SELECT * FROM film WHERE $filter LIKE ?;");
            $mySearch = htmlspecialchars("%".trim($_GET["searchBar"])."%");
            mysqli_stmt_bind_param($stmt, "s", $mySearch); // bind as string
        }

        if(!$stmt){
			error_log("Failed to prepare statement: " . mysqli_error($con)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");		//OJO: gestione errori
			echo "Impossibile preparare la query";
			exit;
		}

        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($res);

        if($count > 0){
            while(($row = mysqli_fetch_assoc($res)) != NULL){
                $data[] = [
                    "nome"=>$row["Nome"],
                    "genere"=>$row["Genere"],
                    "regista"=>$row["Regista"],
                    "paese"=>$row["Paese"],
                    "anno"=>$row["Anno"],
                    //"trama"=>$row["Trama"],
                    "img"=>$row["Img"],
                    "durata"=>$row["Durata"],
                    "casa_produzione"=>$row["Casa_Produzione"]
                ];
            }
            mysqli_stmt_close($stmt);
            //return JSON formatted data
            echo(json_encode($data));
        }
        else{
            //TODO far stampare a tabulator che non ci sono match
            mysqli_stmt_close($stmt);
        }
    }
    catch(mysqli_sql_exception $e){
        echo "Errore Interno";                              //OJO: gestione errori
        error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
    }
}
else{
    try{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        $query = "SELECT * FROM film;";
        $res = mysqli_query($con, $query);
        $count = mysqli_num_rows($res);
        
       /* include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/db_credentials.php");
        $con2 = mysqli_connect(DB_HOST, DB_USER , DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {
            error_log("Failed to connect to MySQL: " . mysqli_connect_error(),3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");		//OJO: gestione errori
            echo "Impossibile collegarsi al Database";
            exit;
        }*/
        //build data array
        if($count > 0){
            while(($row = mysqli_fetch_assoc($res)) != NULL){
                
                //else
                    //$review = NULL;    
                //mysqli_free_result($reviews_res);
                //mysqli_stmt_close($reviews_stmt);
                $data[] = [
                    "nome"=>$row["Nome"],
                    "genere"=>$row["Genere"],
                    "regista"=>$row["Regista"],
                    "paese"=>$row["Paese"],
                    "anno"=>$row["Anno"],
                    //"trama"=>$row["Trama"],
                    "img"=>$row["Img"],
                    "durata"=>$row["Durata"],
                    "casa_produzione"=>$row["Casa_Produzione"],
                    "gradimento"=> ""
                ];
            }
            // mysqli_free_result($res);
            //mysqli_stmt_close($stmt);
            //return JSON formatted data
            echo(json_encode($data));
           
        }
        else
            echo "Impossibile caricare il catalogo";
    }
    catch(mysqli_sql_exception $e){
        echo "Errore Interno";                              //OJO: gestione errori
        error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
    }
}
?>