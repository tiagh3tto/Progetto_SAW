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
        <!--<div class="admin-area-container">-->
            <div class="table-container">
                <h1>Area Amministrativa</h1>
                <div class="admin-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-users-tab" data-bs-toggle="tab" data-bs-target="#all-users-tab-pane" type="button" role="tab" aria-controls="all-users-tab-pane" aria-selected="true">Tabella Utenti</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="moovies-tab" data-bs-toggle="tab" data-bs-target="#moovies-tab-pane" type="button" role="tab" aria-controls="moovies-tab-pane" aria-selected="false">Tabella Film</button>
                        </li>                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all-users-tab-pane" role="tabpanel" aria-labelledby="all-users-tab" tabindex="0">
                            <div class="all-users-tab-buttons ">
                                <button id="ban-users-btn">Ban/Unban Utenti Selezionati</button>
                                <button id="del-users-btn">Elimina Utenti Selezionati</button>
                            </div>    
                            <div id="all-users-table"></div>                   
                        </div>
                        <div class="tab-pane fade" id="moovies-tab-pane" role="tabpanel" aria-labelledby="moovies-tab" tabindex="0">
                            <div class="all-users-tab-buttons ">
                                <button onclick="location.href='/SAW/Progetto_SAW/private/add_film.php';">Aggiungi Film</button>
                                <button id="del-films-btn">Elimina Film Selezionati</button>
                            </div>
                            <div id="all-movies-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        <!--</div>-->    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }   
?>