<?php
try{
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

    $query = "SELECT * FROM film;";
    $res = mysqli_query($con, $query);
    $count = mysqli_num_rows($res);
}
catch(mysqli_sql_exception $e){
    echo "Errore Interno";                              //OJO: gestione errori
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
}
//build data array
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
    //return JSON formatted data
    echo(json_encode($data));
}
else
    echo "Impossibile caricare il catalogo";
?>