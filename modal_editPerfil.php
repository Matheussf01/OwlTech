
    <!-- Modal PERFIL-->
    <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <form action="alterarFoto.php" method="POST" enctype="multipart/form-data">
                            <div class="nav-link img-perfil mr-3">
                                <?php 
                                    if(!empty($usuario_info['foto_perfil']))
                                    {
                                        echo('<img src="'.$usuario_info['foto_perfil'].'">');
                                    }
                                    else
                                    {
                                        echo(' <img src="images/persona.jpg">');
                                    }
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
                                <input type="text" class="form-control" >
                            </div>
                            <div>
                                <label class="col-form-label">Senha:</label>
                                <input type="text" class="form-control" >
                            </div>
                            <div>
                                <label class="col-form-label">Deficiência:</label>
                                <input type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="portal-Beneficiado.php" data-dismiss="modal">Close</a>
                    <a href="portal-Beneficiado.php" data-dismiss="modal">Salvar</a>
                </div>
            </div>
        </div>
    </div>