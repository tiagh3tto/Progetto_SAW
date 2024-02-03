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
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="table1-tab" data-toggle="tab" href="#table1" role="tab" aria-controls="table1" aria-selected="true">Lista Utenti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="table2-tab" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Lista Film</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="table1" role="tabpanel" aria-labelledby="table1-tab">
            <div class="all-users-tab-buttons ">
                <button id="ban-users-btn" class="btn btn-success">Ban/Unban Utenti Selezionati</button>
                <button id="del-users-btn" class="btn btn-danger">Elimina Utenti Selezionati</button>
            </div>    
            <!-- Container for Tabulator table 1 -->
            <div id="all-users-table"></div>
        </div>
        <div class="tab-pane fade" id="table2" role="tabpanel" aria-labelledby="table2-tab">
            <div class="all-users-tab-buttons ">
                <button onclick="location.href='/SAW/Progetto_SAW/private/add_film.php';" class="btn btn-success">Aggiungi Film</button>
                <button id="del-films-btn" class="btn btn-danger">Elimina Film Selezionati</button>
            </div>  
            <!-- Container for Tabulator table 2 -->
            <div id="all-movies-table"></div>
        </div>
    </div>
        <!--</div>-->    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }   
?>