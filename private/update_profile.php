<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['login']) || empty($_SESSION['login']))
        header('Location: /SAW/Progetto_SAW/private/login.php');
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        // Form data
        $fields = array('firstname', 'lastname', 'email', 'dob', 'gender', 'nationality', 'submit');
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $newEmail = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];

        $oldEmail = $_SESSION['email'];

        try{
            mysqli_begin_transaction($con);
            // SQL statement
            $sql = "UPDATE utenti SET Nome=?, Cognome=?, Email=?, Data_Nascita=?, Genere=?, Nazionalità=? WHERE Email=$oldEmail;";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname,  $email, $dob, $gender, $nationality);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                mysqli_commit($con);
                echo "Profile updated successfully.";
            } else if (mysqli_stmt_affected_rows($stmt) > 1) {
                mysqli_rollback($con);
                echo "No changes were made.";
            } else {
                echo "An error occurred while updating your profile.";
            }
        }
        catch(mysqli_sql_exception $e){
            echo "Errore Interno";                              //OJO: gestione errori
        }

        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
    else{
?>
        <div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
            <div class="form-container">
                <h1 class="text-center">Modifica Profilo</h1>
                <form action="registration.php" method="POST" class='row g-3 needs-validation' novalidate>
                    <div class="col-md-5">
                        <label for="validationCustom01" class="form-label">Nome</label>
                        <input type="text" name="firstname" class="form-control" id="validationCustom01" value="" required pattern="[A-Za-z]+" >
                        <div class="valid-feedback">
                            Ottimo!
                        </div>
                        <div class="invalid-feedback">
                            Per favore inserisci un nome valido.
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="validationCustom02" class="form-label">Cognome</label>
                        <input type="text" name="lastname" class="form-control" id="validationCustom02" value="" required pattern="[A-Za-z]+">
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
                        <label for="dob">Data di nascita</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
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
                    <button class="btn btn-primary" name="modify" type="submit">Modifica</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } 
?>