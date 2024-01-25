<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    if( !isset($_SESSION['admin']) || !$_SESSION['admin'] ) //ancora più stringente che controllare 'login'
            header('Location: /SAW/Progetto_SAW/private/login.php');

    else{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
?>     
        <div class="admin-area-container">
            <div class="table-container">
                <h1>Area Amministrativa</h1>
                <div class="admin-content">
                    <div id="all-users-table"></div>
                    <div id="all-movies-table"></div>
                </div>
                <button id="modify-button">Modifica</button>
            </div>
        </div>    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }   
?>