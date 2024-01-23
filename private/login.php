<?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/main/log-form.php");
		include ($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
	}
    else{
        session_start();

        $arr_fields = array('email', 'pass');
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
            $row = mysqli_fetch_array($res, MYSQLI_NUM);  
            $count = mysqli_num_rows($res);
        
            if($count == 1){
                if(password_verify($pwd, $row[4])){
                    $_SESSION['login'] = true;
                    $_SESSION['firstname'] = $row[0];
                    $_SESSION['lastname'] = $row[1];
                    $_SESSION['admin'] = $row[4];
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