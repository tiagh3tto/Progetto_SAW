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
                <h1>Area Riservata</h1>
                <div class="user-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-tab-pane" type="button" role="tab" aria-controls="user-tab-pane" aria-selected="true">Il mio Profilo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Le mie Recensioni</button>
                        </li>                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
                        <button id="modify-usr-data-button" onClick="/SAW/Progetto_SAW/private/update_profile.php">Modifica Profilo</button>                 
                            <p><strong>Per modificare i tuoi dati personali clicca sul pulsante "Modifica Profilo"</strong></p>
                            <div class="profile-content">
                                <img src="/SAW/Progetto_SAW/assets/img/user_icon.png" alt="User Icon" class="user-icon">
                                 
                                <div class="mb-3 col-2">
                                    <label for="firstname" class="form-label">Nome</label>
                                    <p id="firstname">
                                    <?php if(isset($_SESSION["firstname"]))echo $_SESSION["firstname"]; else echo ""?>
                                    </p>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="lastname" class="form-label">Cognome</label>
                                    <p id="lastname">
                                    <?php if(isset($_SESSION["lastname"]))echo $_SESSION["lastname"]; else echo ""?>
                                    </p>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="email" class="form-label">Email</label>
                                    <p id="email">
                                    <?php if(isset($_SESSION["email"]))echo $_SESSION["email"]; else echo ""?>
                                    </p>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="birthdate" class="form-label"><strong>Data di Nascita</strong></label>
                                    <p id="birthdate">
                                    <?php if(isset($_SESSION["birthdate"]))echo $_SESSION["birthdate"]; else echo ""?>
                                    </p>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="gender" class="form-label">Genere</label>
                                    <p id="gender">
                                        <?php if(isset($_SESSION["gender"]))echo $_SESSION["gender"]; else echo ""?>
                                    </p>
                                </div>
                                <div class="mb-3 col-2">
                                    <label for="nationality" class="form-label">Nazionalità</label>
                                    <p id="nationality">
                                    <?php if(isset($_SESSION["nationality"]))echo $_SESSION["nationality"]; else echo ""?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                            <p><strong>Per modificare le tue recensioni seleziona le recensioni da modificare scrivi direttamente sulla tabella in nuovi voti e poi clicca sul pulsante "Modifica Recensione"</strong></p>
                            <button id="modify-usr-reviews-button">Modifica Recensione</button>                 
                            <div class="profile-content">
                                    <div id="reviews-table"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }   
?>