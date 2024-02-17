<?php
   if(!isset($_SESSION))
   {
     session_start();
   }
   if(!isset($_SESSION['login']) || $_SESSION["login"] == false)
   {
     header("Location: /SAW/Progetto_SAW/private/login.php");
   }
   else{
    if($_SERVER["REQUEST_METHOD"] == "POST" )
      {
        try{
        include($_SERVER["DOCUMENT_ROOT"]."/SAW/Progetto_SAW/private/connection.php");;
        $Regia = intval($_POST["Regia"]);
        $Sceneggiatura = intval($_POST["Sceneggiatura"]);
        $Colonna_Sonora = intval($_POST["Colonna_Sonora"]);
        $Recitazione = intval($_POST["Recitazione"]);
        $Fotografia = intval($_POST["Fotografia"]);
        $ID_Utente = intval($_SESSION["ID"]);
        $ID_Film = intval($_SESSION["ID_Film"]);
        $query = "INSERT INTO Recensioni (ID_Utente, ID_Film, Regia, Sceneggiatura, Colonna_Sonora, Recitazione, Fotografia) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iiiiiii", $ID_Utente, $ID_Film, $Regia, $Sceneggiatura, $Colonna_Sonora, $Recitazione, $Fotografia);
        mysqli_stmt_execute($stmt);
        header("Location: /SAW/Progetto_SAW/public/movie_page.php?NomeFilm=".$_SESSION["NomeFilm"]);
      }
        catch(mysqli_sql_exception $e)
        {
            if($e->getCode() == 1062)
            {
                echo "Hai già recensito questo film";
            }
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
            header("Location: /SAW/Progetto_SAW/public/database_error.html");
            exit;
        }
    }
    else include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/review_form.php");
  }
?>