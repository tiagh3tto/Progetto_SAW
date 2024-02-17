<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
try{    
    $query = "SELECT * FROM film WHERE Nome = ?";
    $movie_name = $_GET['NomeFilm'];
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $movie_name);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    define("FILM", $row);
    mysqli_free_result($res);
    
    $query2 = "SELECT AVG(Regia) as Regia,  AVG(Sceneggiatura) as Sceneggiatura, AVG(Fotografia) as Fotografia, AVG(Recitazione) as Recitazione, AVG(Colonna_Sonora) as Colonna_Sonora FROM recensioni WHERE ID_Film = ?";
    $stmt2 = mysqli_prepare($con, $query2);
    mysqli_stmt_bind_param($stmt2, "i", $row["ID"]);
    mysqli_stmt_execute($stmt2);
    $res2 = mysqli_stmt_get_result($stmt2);
    $count = mysqli_num_rows($res2);
    $row2 = mysqli_fetch_assoc($res2);
    if($count == 1){
        $gradimento = ($row2["Regia"] + $row2["Sceneggiatura"] + $row2["Fotografia"] + $row2["Recitazione"] + $row2["Colonna_Sonora"] ) / 5;
        $data = [
            "Gradimento" => intval($gradimento),
            "Regia" => intval($row2["Regia"]),
            "Sceneggiatura" => intval($row2["Sceneggiatura"]),
            "Colonna_Sonora" => intval($row2["Colonna_Sonora"]),
            "Recitazione" => intval($row2["Recitazione"]),
            "Fotografia" => intval($row2["Fotografia"]),
        ];
    }
    else if ($count == 0)
        $data = [
        "Regia" => "Ancora Nessuna Recensione",
        "Sceneggiatura" => "Ancora Nessuna Recensione",
        "Colonna_Sonora" => "Ancora Nessuna Recensione",
        "Recitazione" => "Ancora Nessuna Recensione",
        "Fotografia" => "Ancora Nessuna Recensione",
    ];
    define("REVIEW", ($data));

    mysqli_free_result($res2);
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
}
catch(mysqli_sql_exception $e){
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
    header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
    exit;
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
                    <h2 class="card-title" id="Titolo Film"><?php echo FILM["Nome"]?></h5>
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
                        <li id="Gradimento Generale" style="font-size: 20px; font-weight:bold;">Gradimento Generale: <?php echo REVIEW["Gradimento"]?></li> 
                        <li id="Regia">Regia: <?php echo REVIEW["Regia"]?> </li>
                        <li id="Sceneggiatura">Sceneggiatura: <?php echo REVIEW["Sceneggiatura"]?> </li>
                        <li id="Colonna_Sonora">Colonna Sonora: <?php echo REVIEW["Colonna_Sonora"]?></li>
                        <li id="Recitazione">Recitazione: <?php echo REVIEW["Recitazione"]?> </li>
                        <li id="Fotografia">Fotografia: <?php echo REVIEW["Fotografia"]?> </li>
                    </ul>   
                    <?php
                    if(isset($_SESSION["login"]) && $_SESSION["login"]){
                        if(isset($_SESSION["banned"]) && !$_SESSION["banned"] && !isset($_SESSION["review_error"]) ){
                            $_SESSION["ID_Film"] = FILM["ID"];
                            $_SESSION["NomeFilm"] = FILM["Nome"];
                            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/send_review.php"); 
                        }
                        else if(isset($_SESSION["banned"]) && $_SESSION["banned"] ){
                            echo '<div class="alert alert-danger text-center" role="alert">Non puoi recensire il film perchè sei stato bannato!</div>';
                        }
                        else if(isset($_SESSION["review_error"]) && $_SESSION["review_error"] )
                            echo '<div class="alert alert-danger text-center" role="alert">Hai già recensito questo film! Per modificare la tua recensione vai nella tua area personale!</div>';
                    }
                    ?> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
?>