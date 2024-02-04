<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    else{
        header('Content-Type: application/json');

        $body = file_get_contents('php://input');
        $data = json_decode($body,true);
        $selectedReviews = $data['selectedReviews'];

        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
            $query = "UPDATE recensioni SET Regia = ?, Sceneggiatura = ?, Colonna_Sonora = ?, Recitazione = ?, Fotografia = ? WHERE ID_Utente = ? AND ID_Film = ?;";
            $stmt = mysqli_prepare($con, $query);
            $ID_Utente = $_SESSION['ID'];
            foreach($selectedReviews as $review){
                $regia = intval($review["Regia"]);
                $sceneggiatura = intval($review['Sceneggiatura']);
                $colonna_sonora = intval($review['Colonna_Sonora']);
                $recitazione = intval($review['Recitazione']);
                $fotografia = intval($review['Fotografia']);
                $ID_Film = $review['ID'];
                mysqli_stmt_bind_param($stmt, 'iiiiiii', $regia, $sceneggiatura, $colonna_sonora, $recitazione, $fotografia, $ID_Utente, $ID_Film);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                if(mysqli_affected_rows($con) == 0)
                    $data[] = array("Errore" => "Impossibile modificare la recensione");
            }

            echo json_encode($data);
        }
        catch(mysqli_sql_exception $e){
            echo "Errore Interno";                              //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        }    
    }    
?>