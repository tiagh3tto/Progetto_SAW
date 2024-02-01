<?php
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/private/connection.php");
    $reviews_query = "SELECT Media_Valutazione FROM recensioni WHERE ID_Film = ?;";
          $reviews_stmt = mysqli_prepare($con, $reviews_query);
          $id_film = $_GET['id_film'];
                mysqli_stmt_bind_param($reviews_stmt, "i", $id_film);
                mysqli_stmt_execute($reviews_stmt);
                $reviews_res = mysqli_stmt_get_result($reviews_stmt);
                $count = mysqli_num_rows($reviews_res);
                $review = 0;
                if( $count >= 1){
                    while($reviews_row = mysqli_fetch_array($reviews_res, MYSQLI_NUM) != NULL){
                        $review += $reviews_row[0];
                    }
                    $review = intval($review/$count);
                } 
                echo json_encode($review);
?>