<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    else{
        $data = json_decode($_GET['json']);
        echo $data[0];
    }
?>