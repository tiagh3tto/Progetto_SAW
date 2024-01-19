<?php
    session_start();													//OJO: va messo in registration???
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
				exit("<p>Attenzione! Non hai compilato alcuni campi</p>");       //OJO: gestione errori
			}
		}
		if($_POST["pass"] != $_POST["confirm"]){
			echo "<p> Attenzione! Le password non corrispondono!</p>";			//OJO: gestione errori
			exit;
		}

		include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

		$stmt = mysqli_prepare($con, "INSERT INTO users(Nome,Cognome,Email,Pwd) VALUES (?,?,?,?)");
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
		header("Location: /SAW/es17/private/login.php"); 
	}	
?>