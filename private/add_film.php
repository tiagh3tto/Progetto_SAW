<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['admin']) || !$_SESSION['admin'])
        header('Location: /SAW/Progetto_SAW/private/login.php');

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        $fields = array('nome', 'genere', 'regista', 'paese', 'anno', 'trama', 'casa_produzione', 'durata');
        foreach ($fields as $field) {
            if (!isset( $_POST[$field]) || empty($_POST[$field])) {
                exit("<p>Attenzione! Non hai compilato alcuni campi</p>");       //OJO: gestione errori
                //header("Location: /SAW/Progetto_SAW/public/invalid_input.html");

            }
        }
        if(!isset($_FILES['img']) || $_FILES['img']['error'] > 0){
            exit("<p>Attenzione! Non hai caricato l'immagine</p>");       //OJO: gestione errori
            //header("Location: /SAW/Progetto_SAW/public/invalid_input.html");   

        }

        $nome = filter_var($_POST['nome'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")));
        $genere = filter_var($_POST['genere'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")));
        $regista = filter_var($_POST['regista'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")));
        $paese =  filter_var($_POST['paese'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")));   
        $anno = filter_var($_POST['anno'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>1900, "max_range"=>2024)));
        $trama = filter_var($_POST['trama'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")));
        $img_name = current(explode('.',$_FILES['img']['name']));
        $casa_produzione = filter_var($_POST['casa_produzione'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")));
        $durata = filter_var($_POST['durata'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0)));

        if(!$nome || !$genere || !$regista || !$paese || !$anno || !$trama || !$img_name || !$casa_produzione || !$durata){
            header("Location: /SAW/Progetto_SAW/public/invalid_input.html");   
        }   

        try{
            $sql = "INSERT INTO film (Nome, Genere, Regista, Paese, Anno, Trama, Img, Casa_Produzione, Durata) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ssssisssi", $nome, $genere, $regista, $paese, $anno, $trama, $img_name, $casa_produzione, $durata);
            mysqli_stmt_execute($stmt); //TRY CATCH????????????????

            $errors= array();
            $file_name = $_FILES['img']['name'];
            $file_size =$_FILES['img']['size'];
            $file_tmp =$_FILES['img']['tmp_name'];
            $file_type=$_FILES['img']['type'];
            $file_ext = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));     //get dell'estensione in lowercase
            
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            
            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            
            if(empty($errors)==true){
                move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/assets/img/film/".$file_name);
                header("Location: /SAW/Progetto_SAW/private/add_film.php");
            }else{
                print_r($errors);
            }
        }
        catch (mysqli_sql_exception $e) {
            exit("Errore di connessione al database: ".$e->getMessage());
            //header("Location: /SAW/Progetto_SAW/public/database_error.html");
        }
    }
    else{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
?>
        <div class="table-container d-flex justify-content-center">
            <form action="/SAW/Progetto_SAW/private/add_film.php" method="post" enctype="multipart/form-data" class="w-50">
                <div class="form-group">
                    <label for="nome"><i class="fas fa-film"></i> Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>

                <div class="form-group">
                    <label for="genere"><i class="fas fa-tags"></i> Genere:</label>
                    <input type="text" class="form-control" id="genere" name="genere">
                </div>

                <div class="form-group">
                    <label for="regista"><i class="fas fa-user"></i> Regista:</label>
                    <input type="text" class="form-control" id="regista" name="regista">
                </div>

                <div class="form-group">
                    <label for="paese"><i class="fas fa-globe"></i> Paese:</label>
                    <input type="text" class="form-control" id="paese" name="paese">
                </div>

                <div class="form-group">
                    <label for="anno"><i class="fas fa-globe"></i> Anno:</label>
                    <input type="text" class="form-control" id="anno" name="anno">
                </div>

                <div class="form-group">
                    <label for="trama"><i class="fas fa-book"></i> Trama:</label>
                    <textarea class="form-control" id="trama" name="trama"></textarea>
                </div>

                <div class="form-group">
                    <label for="img"><i class="fas fa-image"></i> Img:</label>
                    <input type="file" class="form-control-file" id="img" name="img">
                </div>

                <div class="form-group">
                    <label for="casa_produzione"><i class="fas fa-industry"></i> Casa Produzione:</label>
                    <input type="text" class="form-control" id="casa_produzione" name="casa_produzione">
                </div>

                <div class="form-group">
                    <label for="durata"><i class="fas fa-clock"></i> Durata:</label>
                    <input type="text" class="form-control" id="durata" name="durata">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }
?>