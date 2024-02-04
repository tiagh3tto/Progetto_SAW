<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    } 													//OJO: va messo in registration???
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/main/reg-form.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
	}
	else{
		$arr_fields = array('firstname', 'lastname', 'email', 'pass', 'confirm', 'submit');
		foreach ($arr_fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
				exit("<p>Attenzione! Non hai compilato alcuni campi</p>");       //OJO: gestione errori
			}
		}
		if($_POST["pass"] != $_POST["confirm"]){
			echo "<p> Attenzione! Le password non corrispondono!</p>";			//OJO: gestione errori
			exit;
		}
		try{
		include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

		$stmt = mysqli_prepare($con, "INSERT INTO utenti(Nome,Cognome,Email,Password) VALUES (?,?,?,?)");
		if(!$stmt){
			error_log("Failed to prepare statement: " . mysqli_error($con)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/private/logs/errors.log");		//OJO: gestione errori
			echo "Impossibile preparare la query";
			exit;
		}

		mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $mail, $pass);
		
		$fname = htmlspecialchars(trim($_POST["firstname"]));
		$lname = htmlspecialchars(trim($_POST["lastname"]));
		$mail = htmlspecialchars(trim($_POST["email"]));
		$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

		mysqli_stmt_execute($stmt);

		//checking for errors
		if(mysqli_affected_rows($con) < 1 || mysqli_stmt_errno($stmt) != 0){
			error_log("Failed to execute statement: " . mysqli_stmt_error($stmt)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/private/logs/errors.log");	//OJO: gestione errori
			echo "<p>Attenzione! Non è stato possibile registrarti</p>";
			exit;
		}
		
		mysqli_stmt_close($stmt);
		header("Location: /SAW/Progetto_SAW/private/login.php"); 
		}
		catch(mysqli_sql_exception $e){
			//chiave duplicata
			if($e->getCode() == 1062){
				echo "Hai già un account"; 
			}
			//violata colonna not null
			else if($e->getCode() == 1048){
				echo "Attenzione! Non hai compilato alcuni campi"; 
			}
			else echo "Errore Interno";                              //OJO: gestione errori
			error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");
		}	
	}	
?>