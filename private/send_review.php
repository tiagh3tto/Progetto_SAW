<?php
    include_once(dirname(__FILE__)."/../phpinfo.php");

  if(!isset($_SESSION)){
    session_start();
  }
  if(!isset($_SESSION['login']) || $_SESSION["login"] == false){
    header("Location: login.php");
  }
  if(!isset($_SESSION["ID_Film"]) || empty($_SESSION["ID_Film"])){
    header("Location: ../public/movie_page.php?NomeFilm=".$_SESSION["NomeFilm"]);
  }
  else{
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      include(DOCUMENT_ROOT."/private/connection.php");
      try{
        $Regia = intval($_POST["Regia"]);
        $Sceneggiatura = intval($_POST["Sceneggiatura"]);
        $Colonna_Sonora = intval($_POST["Colonna_Sonora"]);
        $Recitazione = intval($_POST["Recitazione"]);
        $Fotografia = intval($_POST["Fotografia"]);
        $ID_Utente = intval($_SESSION["ID"]);
        $ID_Film = intval($_SESSION["ID_Film"]);
        $query = "INSERT INTO recensioni (ID_Utente, ID_Film, Regia, Sceneggiatura, Colonna_Sonora, Recitazione, Fotografia) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iiiiiii", $ID_Utente, $ID_Film, $Regia, $Sceneggiatura, $Colonna_Sonora, $Recitazione, $Fotografia);
        mysqli_stmt_execute($stmt);
        header("Location: ../public/movie_page.php?NomeFilm=".$_SESSION["NomeFilm"]);
      }
        catch(mysqli_sql_exception $e)
        {
            if($e->getCode() == 1062)
            {
                $_SESSION["review_error"] = true;
                header("Location: ../public/movie_page.php?NomeFilm=".$_SESSION["NomeFilm"]);
                exit;
            }
            error_log($e->getMessage(), 3, DOCUMENT_ROOT."/private/logs/errors.log");
            header("Location: ../public/unexpected_error.php");
            exit;
        }
    }
  else
    include(DOCUMENT_ROOT."/private/review_form.php");
  }
?>