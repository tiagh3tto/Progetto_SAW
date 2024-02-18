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

        $arr_fields = array('email', 'pass');
		foreach ($arr_fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
				header('Location: /SAW/Progetto_SAW/public/invalid_input.php');
                exit;
			}
		}

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $pwd = filter_var($_POST['pass'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.{8,}$/")));

        if(!$email || !$pwd){
            header("Location: /SAW/Progetto_SAW/public/invalid_input.php");
            exit;
        }

        include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

        try{
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
                    $_SESSION['ID'] = htmlspecialchars($row["ID"]);
                    $_SESSION['banned'] = htmlspecialchars($row["Banned"]);
                    $_SESSION['firstname'] = htmlspecialchars($row["Nome"]);
                    $_SESSION['lastname'] = htmlspecialchars($row["Cognome"]);
                    $_SESSION['email'] = htmlspecialchars($row["Email"]);
                    $_SESSION['birthdate'] = htmlspecialchars($row["Data_Nascita"]);
                    $_SESSION['gender'] = htmlspecialchars($row["Sesso"]);
                    $_SESSION['nationality'] = htmlspecialchars($row["Nazionalita"]);
                    $_SESSION['admin'] = htmlspecialchars($row["Admin"]);
                    header('Location: /SAW/Progetto_SAW/public/index.php');
                    exit;
                }
                header('Location: /SAW/Progetto_SAW/public/invalid_input.php');
                exit;
            }  
            else{
                header('Location: /SAW/Progetto_SAW/public/unexpected_error.php');
                exit;
            }
        }
        catch(mysqli_sql_exception $e){
            error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
            header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
            exit;
        }
    }
?>   