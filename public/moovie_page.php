<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
try{    
    $query = "SELECT * FROM film WHERE Nome = ?";
    $movie_name = $_GET['NomeFilm'];
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $movie_name);
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    define("FILM", $row);
    mysqli_free_result($res);
    
    $query2 = "SELECT AVG(Regia) as Regia,  AVG(Sceneggiatura) as Sceneggiatura, AVG(Fotografia) as Fotografia, AVG(Recitazione) as Recitazione, AVG(Colonna_Sonora) as Colonna_Sonora FROM recensioni WHERE ID_Film = ?";
    $stmt2 = mysqli_prepare($con, $query2);
    mysqli_stmt_bind_param($stmt2, "i", $row["ID"]);
    mysqli_execute($stmt2);
    $res2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($res2);
    $count = mysqli_num_rows($res2);
    if($count == 1){
        /*$regia = 0;
        $sceneggiatura = 0;
        $colonna_sonora = 0;
        $recitazione = 0;
        $fotografia = 0;
        $iterator = 0;
        while($row = mysqli_fetch_assoc($res)){
                $regia += $row["Regia"];
                $sceneggiatura += $row["Sceneggiatura"];
                $colonna_sonora += $row["Colonna_Sonora"];
                $recitazione += $row["Recitazione"];
                $fotografia += $row["Fotografia"];
                $iterator++;
        }
        if($iterator == 0){
            $iterator = 1;
        }*/
        $data = [
            "Regia" => intval($row2["Regia"]),//$regia/$iterator,
            "Sceneggiatura" => intval($row2["Sceneggiatura"]),//$sceneggiatura/$iterator,
            "Colonna_Sonora" => intval($row2["Colonna_Sonora"]),//$colonna_sonora/$iterator,
            "Recitazione" => intval($row2["Recitazione"]),//$recitazione/$iterator,
            "Fotografia" => intval($row2["Fotografia"]),//$fotografia/$iterator,
        ];
    }
    else 
      $data = [
        "Regia" => "Ancora Nessuna Recensione",
        "Sceneggiatura" => "Ancora Nessuna Recensione",
        "Colonna_Sonora" => "Ancora Nessuna Recensione",
        "Recitazione" => "Ancora Nessuna Recensione",
        "Fotografia" => "Ancora Nessuna Recensione",
    ];
    define("REVIEW", ($data));

}
catch(mysqli_sql_exception $e){
    echo "Errore Interno";                              //OJO: gestione errori
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
}    
?>
<div class="container mt-5">
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img id="moviePoster" src="/SAW/Progetto_SAW/assets/img/film/<?php echo FILM['Img']?>.jpg" class="card-img" alt="Locandina">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" id="Titolo Film"><?php echo FILM["Nome"]?></h5>
                    <p class="card-text" id="Descrizione_Film"><?php echo FILM["Trama"]?></p>
                    <h2>Dettagli</h2>
                    <ul>
                        <li id="Regista">Regista: <?php echo FILM["Regista"]?> </li>
                        <li id="Genere">Genere: <?php echo FILM["Genere"]?> </li>
                        <li id="Durata">Durata: <?php echo FILM["Durata"]?> min</li>
                        <li id="Paese">Paese: <?php echo FILM["Paese"]?> </li>
                        <li id="Anno_Uscita">Anno di Uscita: <?php echo FILM["Anno"]?> </li>
                        <li id="Casa_Produzione">Casa di Produzione: <?php echo FILM["Casa_Produzione"]?> </li>
                    </ul>
                    <h2>Valutazione</h2>
                    <ul>
                        <li id="Regia">Regia: <?php echo REVIEW["Regia"]?> </li>
                        <li id="Sceneggiatura">Sceneggiatura: <?php echo REVIEW["Sceneggiatura"]?> </li>
                        <li id="movieDuration">Colonna Sonora: <?php echo REVIEW["Colonna_Sonora"]?></li>
                        <li id="movieCountry">Recitazione: <?php echo REVIEW["Recitazione"]?> </li>
                        <li id="movieReleaseDate">Fotografia: <?php echo REVIEW["Fotografia"]?> </li>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
?>