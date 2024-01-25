<?php
try{
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

    $query = "SELECT Nome, Genere, Regista, Paese, Anno, Descrizione, Img FROM film;";
    $res = mysqli_query($con, $query);
    $count = mysqli_num_rows($res);
}
catch(mysqli_sql_exception $e){
    echo "Errore Interno";                              //OJO: gestione errori
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
}
//build data array
if($count > 0){
    while(($row = mysqli_fetch_array($res)) != NULL){
        $data[] = [
            "nome"=>$row[0],
            "genere"=>$row[1],
            "regista"=>$row[2],
            "paese"=>$row[3],
            "anno"=>$row[4],
            "descrizione"=>$row[5],
            "img"=>$row[6]
        ];
    }
}
    //return JSON formatted data
echo(json_encode($data));
?>