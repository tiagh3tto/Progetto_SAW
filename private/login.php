<?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/main/log-form.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
	}
    else{
        if(!isset($_SESSION)) { 
            session_start(); 
        } 

        $arr_fields = array('email', 'pass', 'submit');
		foreach ($arr_fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
				exit("<p>Attenzione! Non hai compilato alcuni campi</p>");       //OJO: gestione errori
			}
		}

        $email = $_POST['email'];                                               //OJO: solo se esistono i campi
        $pwd = $_POST['pass'];

        try{
            include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
        
            $query = "SELECT * FROM utenti WHERE Email = ?;";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $res=mysqli_stmt_get_result($stmt);  
            $row = mysqli_fetch_assoc($res);  
            $count = mysqli_num_rows($res);
        
            if($count == 1){
                if(password_verify($pwd, $row["Password"])){
                    $_SESSION['login'] = true;
                    $_SESSION['ID'] = $row["ID"];
                    $_SESSION['banned'] = $row["Ban"];
                    $_SESSION['firstname'] = $row["Nome"];
                    $_SESSION['lastname'] = $row["Cognome"];
                    $_SESSION['email'] = $row["Email"];
                    $_SESSION['admin'] = $row["Admin"];
                    header('Location: /SAW/Progetto_SAW/public/index.php');                                        //da creare
                }
                echo "errore1";                                                             //OJO: gestione errori
            }  
            else{  
                echo "errore2";                                                             //OJO: gestione errori
            }

            mysqli_free_result($res);
        }
        catch(mysqli_sql_exception $e){
            echo "something went wrong in the login";                                       //OJO: gestione errori
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
        }
    }
?>   