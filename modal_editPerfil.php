<div class="form-group">
    <form action="alterarFoto.php" method="POST" enctype="multipart/form-data">
        <div class="nav-link img-perfil mr-3">
            <?php 
                echo('<img src="'.$usuario_info['foto_perfil'].'">');
            ?>
        </div>
        <div>
            <label   label class="col-form-label mr-5">Mudar foto de perfil</label>
            <input type="file" name="image" value="Selecione um arquivo">
            <input type="submit" name="alterarFoto" class="btn" value="Alterar">
        </div>
    </form>
    <form action="">
        <div>
            <label class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="recipient-name">
        </div>
        <div>
            <label class="col-form-label">Cargo:</label>
            <input type="text" class="form-control" id="recipient-name">
        </div>
        <div>
            <label class="col-form-label">Deficiência:</label>
            <input type="text" class="form-control" id="recipient-name">
        </div>

        <div>
            <label class="col-form-label">Bio:</label>
            <textarea class="form-control" id="message-text"></textarea>
        </div>
    </form>
</div>