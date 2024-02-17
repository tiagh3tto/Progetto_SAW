<?php
//se viene chiamato get_catalog dalla searchbar
if((isset($_GET["searchBar"]) && isset($_GET["filter"])) && (!empty($_GET["searchBar"]) && !empty($_GET["filter"]))){
    try{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        $allowed_cols = ['Nome', 'Genere', 'Regista', 'Paese', 'Anno', 'Casa_Produzione']; // replace with your actual column names
        $filter = $_GET["filter"];
        if (!in_array($filter, $allowed_cols)) {
            //exit('Invalid filter');                         //OJO da gestire errore
            header("Location: /SAW/Progetto_SAW/public/invalid_input.php");
            exit;
        }

        if($filter == "Anno") {
            $_GET["searchBar"] = intval($_GET["searchBar"]); // convert searchBar to integer
            $stmt = mysqli_prepare($con, "SELECT * FROM film WHERE $filter = ?;");
            mysqli_stmt_bind_param($stmt, "i", $_GET["searchBar"]); // bind as integer
        } else {
            $stmt = mysqli_prepare($con, "SELECT * FROM film WHERE $filter LIKE ?;");
            $mySearch = "%".trim($_GET["searchBar"])."%";
            mysqli_stmt_bind_param($stmt, "s", $mySearch); // bind as string
        }

        /*if(!$stmt){
			error_log("Failed to prepare statement: " . mysqli_error($con)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");		//OJO: gestione errori
			echo "Impossibile preparare la query";
			exit;
		}*/

        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($res);

        if($count > 0){
            while(($row = mysqli_fetch_assoc($res)) != NULL){
                $data[] = [
                    "id" => intval($row["ID"]),
                    "nome"=> htmlspecialchars($row["Nome"]),
                    "genere"=>htmlspecialchars($row["Genere"]),
                    "regista"=>htmlspecialchars($row["Regista"]),
                    "paese"=>htmlspecialchars($row["Paese"]),
                    "anno"=> intval($row["Anno"]),
                    "img"=> $row["Img"],
                    "durata"=>htmlspecialchars($row["Durata"]),
                    "casa_produzione"=>htmlspecialchars($row["Casa_Produzione"])
                ];
            }
            mysqli_stmt_close($stmt);
            echo(json_encode($data));
        }
        else{
            echo(json_encode(array()));
            mysqli_stmt_close($stmt);
        }
    }
    catch(mysqli_sql_exception $e){
        //echo "Errore Interno";                              //OJO: gestione errori
        error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
        exit;
    }
}
else{
    try{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        $query = "SELECT * FROM film;";
        $res = mysqli_query($con, $query);
        $count = mysqli_num_rows($res);
        if($count > 0){
            while(($row = mysqli_fetch_assoc($res)) != NULL){
                $data[] = [
                    "id" => intval($row["ID"]),
                    "nome"=>htmlspecialchars($row["Nome"]),
                    "genere"=>htmlspecialchars($row["Genere"]),
                    "regista"=>htmlspecialchars($row["Regista"]),
                    "paese"=>htmlspecialchars($row["Paese"]),
                    "anno"=> intval($row["Anno"]),
                    "img"=>$row["Img"],
                    "durata"=> intval($row["Durata"]),
                    "casa_produzione"=> htmlspecialchars($row["Casa_Produzione"]),
                ];
            }
            mysqli_free_result($res);
            mysqli_close($con);
            //return JSON formatted data
            echo json_encode($data);
        }
        else
            echo json_encode(array("Errore" => "Impossibile caricare il catalogo"));

    }
    catch(mysqli_sql_exception $e){
        //echo "Errore Interno";                              //OJO: gestione errori
        error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
        exit;
    }
}
?>