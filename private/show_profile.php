<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    else{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
?>     
        <div class="show-profile-container">
            <div class="table-container">
                <h1>Il mio Profilo</h1>
                <div class="profile-content">
                    <img src="/SAW/Progetto_SAW/assets/img/user_icon.png" alt="User Icon" class="user-icon">
                    <div id="profile-table"></div>
                </div>
                <button id="modify-usr-data-button">Modifica Profilo</button>
            </div>
        </div>    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
         }   
?>