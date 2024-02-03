<?php
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/head.php");
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/navbar/navbar.php");
?>
<div class="table-container d-flex justify-content-center">
    <form action="/SAW/Progetto_SAW/private/add_film.php" method="post" enctype="multipart/form-data" class="w-50">
        <div class="form-group">
            <label for="nome"><i class="fas fa-film"></i> Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>

        <div class="form-group">
            <label for="genere"><i class="fas fa-tags"></i> Genere:</label>
            <input type="text" class="form-control" id="genere" name="genere">
        </div>

        <div class="form-group">
            <label for="regista"><i class="fas fa-user"></i> Regista:</label>
            <input type="text" class="form-control" id="regista" name="regista">
        </div>

        <div class="form-group">
            <label for="paese"><i class="fas fa-globe"></i> Paese:</label>
            <input type="text" class="form-control" id="paese" name="paese">
        </div>

        <div class="form-group">
            <label for="trama"><i class="fas fa-book"></i> Trama:</label>
            <textarea class="form-control" id="trama" name="trama"></textarea>
        </div>

        <div class="form-group">
            <label for="img"><i class="fas fa-image"></i> Img:</label>
            <input type="file" class="form-control-file" id="img" name="img">
        </div>

        <div class="form-group">
            <label for="casa_produzione"><i class="fas fa-industry"></i> Casa Produzione:</label>
            <input type="text" class="form-control" id="casa_produzione" name="casa_produzione">
        </div>

        <div class="form-group">
            <label for="durata"><i class="fas fa-clock"></i> Durata:</label>
            <input type="text" class="form-control" id="durata" name="durata">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php
    include($_SERVER['DOCUMENT_ROOT']."/SAW/Progetto_SAW/components/footer.php");
?>