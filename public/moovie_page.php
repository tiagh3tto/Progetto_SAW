<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
try{    
    $query = "SELECT * FROM film WHERE Nome = ?";
    $movie_id = $_GET['NomeFilm'];
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $movie_id);
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    define("FILM", mysqli_fetch_assoc($res));
    mysqli_free_result($res);

    /*$query = "SELECT * FROM recensioni WHERE ID_FILM = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $movie_id);
    mysqli_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    define("REVIW", mysqli_fetch_assoc($res));*/
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
                        <li id="movieDirector">Regista: <?php echo FILM["Regista"]?> </li>
                        <li id="movieGenre">Genere: <?php echo FILM["Genere"]?> </li>
                        <li id="movieDuration">Durata: <?php echo FILM["Durata"]?> min</li>
                        <li id="movieCountry">Paese: <?php echo FILM["Paese"]?> </li>
                        <li id="movieReleaseDate">Anno di Uscita: <?php echo FILM["Anno"]?> </li>
                        <li id="movieProduction">Casa di Produzione: <?php echo FILM["Casa_Produzione"]?> </li>
                    </ul>
                    <h2>Valutazione</h2>
                    <ul>
                        <li id="movieDirector">Regia: <?php echo REVIW["Regia"]?> </li>
                        <li id="movieGenre">Sceneggiatura: <?php echo REVIW["Sceneggiatura"]?> </li>
                        <li id="movieDuration">Colonna Sonora: <?php echo REVIW["Colonna_Sonora"]?> min</li>
                        <li id="movieCountry">Recitazione: <?php echo REVIW["Recitazione"]?> </li>
                        <li id="movieReleaseDate">Fotografia: <?php echo REVIW["Fotografia"]?> </li>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
?>