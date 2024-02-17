<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        // Form data
        $fields = array('firstname', 'lastname', 'email');
        foreach ($fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
                header("Location: /SAW/Progetto_SAW/public/invalid_input.html");
                exit;
            }
		}
        $firstname = htmlspecialchars(trim($_POST['firstname']));
        $lastname = htmlspecialchars(trim($_POST['lastname']));
        $newEmail = htmlspecialchars(trim($_POST['email']));
        $birthdate = htmlspecialchars(trim($_POST['birthdate']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $nationality = htmlspecialchars(trim($_POST['nationality']));

        $oldEmail = $_SESSION['email'];

        try{
            // SQL statement
            $sql = "UPDATE utenti SET Nome=?, Cognome=?, Email=?, Data_Nascita=?, Genere=?, Nazionalità=? WHERE Email=?;";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname,  $newEmail, $birthdate, $gender, $nationality, $oldEmail);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                $_SESSION['firstname'] = $_POST['firstname'];
                $_SESSION['lastname'] = $_POST['lastname'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['birthdate'] = $_POST['birthdate'];
                $_SESSION['gender'] = $_POST['gender'];
                $_SESSION['nationality'] = $_POST['nationality'];
                header('Location: /SAW/Progetto_SAW/private/show_profile.php');
                exit;
            } else if (mysqli_stmt_affected_rows($stmt) > 1) {
                echo "No changes were made.";
            } else {
                echo "An error occurred while updating your profile.";
            }
        }
        catch(mysqli_sql_exception $e){
            echo "Errore Interno: " . $e->getMessage();                              //OJO: gestione errori
        }
    }
    else{
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
?>
        <div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
            <div class="form-container">
                <h1 class="text-center">Modifica Profilo</h1>
                <form action="update_profile.php" method="POST" class='row g-3 needs-validation' novalidate>
                    <div class="col-md-5">
                        <label for="validationCustom01" class="form-label">Nome</label>
                        <input type="text" name="firstname" class="form-control" id="validationCustom01" value="" required pattern="[A-Za-z ]+" >
                        <div class="valid-feedback">
                            Ottimo!
                        </div>
                        <div class="invalid-feedback">
                            Per favore inserisci un nome valido.
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="validationCustom02" class="form-label">Cognome</label>
                        <input type="text" name="lastname" class="form-control" id="validationCustom02" value="" required pattern="[A-Za-z ]+">
                        <div class="valid-feedback">
                            Ottimo!
                        </div>
                        <div class="invalid-feedback">
                            Per favore inserisci un cognome valido.
                        </div>
                    </div>

                    <div class="col-md-7">
                        <label for="validationCustomEmail" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" name="email" class="form-control" id="validationCustomEmail" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Per favore inserisci una mail valida.
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="birthdate">Data di nascita</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Genere</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="maschio">Maschio</option>
                            <option value="femmina">Femmina</option>
                            <option value="altro">Altro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nationality">Nazionalità</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" required>
                    </div>

                    <div class="col-12">
                    <button class="btn btn-primary" name="submit" type="submit">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
    }
?>