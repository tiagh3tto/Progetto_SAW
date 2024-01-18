<?php
	//error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
	//check cookie persistente
    session_start();
	/*if(isset($_COOKIE['Rememberme']) && !empty($_COOKIE['Rememberme'])){
        header("Location: /SAW/es17/private/login.php");
    }*/

	//ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment
	//checking fileds initializiation
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/body_start.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
		/*echo"	<img src='/SAW/es17/public/img/main.jpg' alt='Cappuccino'>
		<form id='regform' name='regform' method='POST' action='/SAW/es17/private/registration.php'>
			<fieldset>
				<legend>Inserisci qui i tuoi dati per la registrazione</legend>
				<p>
					<span>Nome: <input type='text' id='firstname' name='firstname'></span>
					<span>Cognome: <input type='text' id='lastname' name='lastname'></span>
					<span>Email: <input type='email' id='email' name='email'></span>
					<span>Password: <input type='password' id='pass' name='pass'></span>
					<span>Conferma Password: <input type='password' id='confirm' name='confirm'></span>
			</p>
			<p><button type='submit'>Registrati</button></p>
			</fieldset>
		</form>";*/
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/reg-form.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
	}
	else{
		$arr_fields = array('firstname', 'lastname', 'email', 'pass', 'confirm');
		foreach ($arr_fields as $field) {
			if (!isset( $_POST[$field]) || empty($_POST[$field])) {
				exit("<p>Attenzione! Non hai compilato alcuni campi</p>");       //return vs exit
			}
		}
		//checking password matching
		if($_POST["pass"] != $_POST["confirm"]){
			echo "<p> Attenzione! Le password non corrispondono!</p>";
			exit;
		}

		include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");

		//preparing statement
		$stmt = mysqli_prepare($con, "INSERT INTO users(Nome,Cognome,Email,Pwd) VALUES (?,?,?,?)");
		if(!$stmt){
			error_log("Failed to prepare statement: " . mysqli_error($con)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/es17/errors.txt");
			echo "Impossibile preparare la query";
			exit;
		}
		//binding parameters
		mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $mail, $pass);
		
		$fname = htmlspecialchars(trim($_POST["firstname"]));
		$lname = htmlspecialchars(trim($_POST["lastname"]));
		$mail = htmlspecialchars(trim($_POST["email"]));
		$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);


		//executing statement
		mysqli_stmt_execute($stmt);
		//checking for errors
		if(mysqli_affected_rows($con) < 1 || mysqli_stmt_errno($stmt) != 0){
			error_log("Failed to execute statement: " . mysqli_stmt_error($stmt)."\n",3, $_SERVER['DOCUMENT_ROOT']."/SAW/es17/errors.txt");
			echo "<p>Attenzione! Non è stato possibile registrarti</p>";
			exit;
		}
		
		//closing statement
		mysqli_stmt_close($stmt);
		header("Location: /SAW/es17/private/login.php"); 
	}	
?>