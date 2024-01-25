<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/SAW/Progetto_SAW/public/index.php"><img src="../assets/img/logo2.png" alt="Logo"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto centered-nav">
            <li class="nav-item">
                <a class="nav-link" href="/SAW/Progetto_SAW/public/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SAW/Progetto_SAW/public/catalog.php">Catalogo</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php
                        if(!isset($_SESSION)) { 
                            session_start(); 
                        } 
                        if(isset($_SESSION['login']) && !empty($_SESSION['login'])){
                            if(isset($_SESSION['admin']) && $_SESSION['admin']){
                                echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/show_profile.php'>Area riservata</a>";
                                echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/admin_area.php'>Area amministrativa</a>";
                                echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/logout.php'>Esci</a>";
                            }
                            else{
                                echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/show_profile.php'>Area riservata</a>";
                                echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/logout.php'>Esci</a>";
                            }
                        }
                        else{
                            echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/registration.php'>Registrati</a>";
                            echo "<a class='dropdown-item' href='/SAW/Progetto_SAW/private/login.php'>Accedi</a>";
                        }
                    ?>    
                </div>
            </li>
        </ul>
    </div>
</nav>