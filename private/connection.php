<?php
//retriving db credential
	$filename = $_SERVER['DOCUMENT_ROOT']."/SAW/es10/credenziali.txt";
	if (!$fp = fopen($filename, 'r')) {
		echo "Impossibile aprire il file ($filename)";
		exit;
	}
	if ($fp) {
		flock($fp, LOCK_EX);
		if (($line = fgets($fp, filesize($filename))) !== FALSE) {
			list($db_usr, $db_pwd, $db_name) = explode("\t", $line);
			trim($db_name);
			trim($db_pwd);
			trim($db_usr);
			}		
		else{
			echo "Errore: la funzione fgets() è fallita inaspettatamente\n";
			exit;
		}
		flock($fp, LOCK_UN);
		fclose($fp);		
	}
	else {
    	echo "Il file ($filename) non ha i permessi di lettura";
	}
	//connecting to db
	$con = mysqli_connect("localhost", $db_usr ,$db_pwd , $db_name);
	if (mysqli_connect_errno()) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error(),3, $_SERVER['DOCUMENT_ROOT']."/SAW/es17/errors.log");
		echo "Impossibile collegarsi al Database";
		exit;
	}
?>