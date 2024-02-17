<?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/main/reg-form.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
	}
	else{
		$arr_fields = array('firstname', 'lastname', 'email', 'pass', 'confirm');
		foreach ($arr_fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
				header("Location: /SAW/Progetto_SAW/public/invalid_input.php");
				exit;
			}
		}
		if($_POST["pass"] != $_POST["confirm"]){
			header("Location: /SAW/Progetto_SAW/public/invalid_input.php");
			exit;
		}

		$fname = filter_var(trim($_POST["firstname"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")));
		$lname = filter_var(trim($_POST['lastname']) , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")));
		$mail = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
		$pass = filter_var($_POST['pass'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^.{8,}$/")));

		if(!$fname || !$lname || !$mail || !$pass){
            header("Location: /SAW/Progetto_SAW/public/invalid_input.php");
			exit; 
        }

		$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

		include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

		try{
			$stmt = mysqli_prepare($con, "INSERT INTO utenti(Nome,Cognome,Email,Password) VALUES (?,?,?,?)");

			mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $mail, $pass);

			mysqli_stmt_execute($stmt);

			if(mysqli_affected_rows($con) < 1){
				header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
				exit; 
			}			
			mysqli_stmt_close($stmt);
			header("Location: /SAW/Progetto_SAW/private/login.php"); 
			exit;
		}
		catch(mysqli_sql_exception $e){
			error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
			if($e->getCode() == 1062){
				header("Location: /SAW/Progetto_SAW/public/not_available_account.php");
				exit; 
			}
			else{
				header("Location: /SAW/Progetto_SAW/public/unexpected_error.php");
				exit; 
			}
		}	
	}	
?>