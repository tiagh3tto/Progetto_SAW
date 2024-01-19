<?php
	$filename = $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/db_credentials.txt";
	if (!$fp = fopen($filename, 'r')) {
		echo "Impossibile aprire il file ($filename)";										//OJO: gestione errori
		exit;
	}
	if ($fp) {
		flock($fp, LOCK_SH);
		if (($line = fgets($fp, filesize($filename))) !== FALSE) {
			list($server_name, $db_usr, $db_pwd, $db_name) = explode("\t", $line);
			trim($db_name);
			trim($db_pwd);																	//OJO: dovremmo hashare la pwd nel file delle credenziali????	
			trim($db_usr);
			}		
		else{
			echo "Errore: la funzione fgets() è fallita inaspettatamente\n";				//OJO: gestione errori
			exit;
		}
		flock($fp, LOCK_UN);
		fclose($fp);		
	}
	else {
    	echo "Il file ($filename) non ha i permessi di lettura";							//OJO: gestione errori
	}

	$con = mysqli_connect($server_name, $db_usr ,$db_pwd , $db_name);
	if (mysqli_connect_errno()) {
		error_log("Failed to connect to MySQL: " . mysqli_connect_error(),3, $_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/logs/errors.log");		//OJO: gestione errori
		echo "Impossibile collegarsi al Database";
		exit;
	}
?>