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
            <button type="button" class="btn btn-primary add-user">Add User</button>
<button type="button" class="btn btn-danger delete-user">Delete User</button>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="table2-tab" data-toggle="tab" href="#table2" role="tab" aria-controls="table2" aria-selected="false">Lista Film</a>
            <button type="button" class="btn btn-primary add-film">Add Film</button>
<button type="button" class="btn btn-danger delete-film">Delete Film</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="table1" role="tabpanel" aria-labelledby="table1-tab">
            <!-- Container for Tabulator table 1 -->
            <div id="all-users-table"></div>
        </div>
        <div class="tab-pane fade" id="table2" role="tabpanel" aria-labelledby="table2-tab">
            <!-- Container for Tabulator table 2 -->
            <div id="all-movies-table"></div>
        </div>
    </div>
        <!--</div>-->    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }   
?>