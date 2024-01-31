<?php
if(isset($_POST["searchBar"]) && isset($_POST["filter"])){
    header("Location: /SAW/Progetto_SAW/public/catalog.php?searchBar=".$_POST["searchBar"]."&filter=".$_POST["filter"]);
    exit();
}
else{
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/tables/catalog_table.php");
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
}
?>