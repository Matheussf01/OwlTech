<?php
 
  
    if( empty($_SESSION['id']))
    {
        /*verifica se existem as informações*/
        session_destroy();
        header('location:index.php');
    }
    else
    { 

     ?>  


        <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
            <a class="navbar-brand" href="index.php">
                <img src="images/owlbility.png" alt="logo Dow">
            </a>
            <div class="d-flex align-items-center">

            <?php   if($_SESSION['deficiencia'] == 0){ ?>
                <div class="itens-menu">
                    <a href="#" data-toggle="modal" data-target="#contribuicoesModal" onclick='abreContribuicoes()' > Contribuições </a>
                    <a href="#" data-toggle="modal" data-target="#recompensasModal" > Recompensas </a>

                </div>
            <?php } ?>


                <div>
                    <a class="nav-link  img-perfil d-flex align-items-center justify-content-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                        echo('<img src="'.$usuario_info['foto_perfil'].'">');
                        ?>
                    
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="editPerfil" href="#" data-toggle="modal" data-target="#perfilModal">Perfil</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#faleConoscoModal">Fale Conosco</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="sair.php">Sair</a>
                    </div>
                </div>
            </div>
        </nav>

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
                        <form action="alterarFoto.php" class="image-perfil" method="POST" enctype="multipart/form-data">
                            <div class="nav-link img-perfil mr-3">
                                <?php 
                                    echo('<img src="'.$usuario_info['foto_perfil'].'">');
                                ?>
                            </div>
                            <div>
                                <div class="button-wrapper">
                                    <span class="label">
                                        Escolha uma imagem
                                    </span>
                                    <input type="file" name="upload" id="upload" class="upload-box" placeholder="Upload File">
                                <input class="alterar" type="submit" name="alterarFoto" class="btn" value="Alterar Foto">
                                </div>
                            </div>
                        </form>
                        <form action="">
                            <div>
                                <label class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="recipient-name" value="">
                            </div>
                            <div>
                                <label class="col-form-label">Senha:</label>
                                <input type="text" class="form-control" name="senha" id="recipient-name" value="">
                            </div>
                            <div>
                                <label class="col-form-label">Deficiência:</label>
                                <input type="text" class="form-control" name="deficiencia" id="recipient-name" value="">
                            </div>
                            <div>
                                <label class="col-form-label">E-mail:</label>
                                <input type="text" class="form-control" name="email" id="recipient-name" value="">
                            </div>
                            <div class="field question" value="">
                                <p>Tem alguma Deficiência?</p>
                                <select name="deficiencia" id="">
                                    <option value="">Não</option>
                                    <option value="Visual">Visual</option>
                                </select>
                            </div>

                        </form>
                    </div>

                </div>


                <div class="modal-footer">
                    <a href="#" data-dismiss="modal">Fechar</a>
                    <a href="#" data-dismiss="modal">Salvar</a>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="recompensasModal" tabindex="-1" role="dialog" aria-labelledby="recompensasModalTitle" aria-hidden="true">
    <?php include('modal_recompensas.php');?>
</div>

<div class="modal fade" id="contribuicoesModal" tabindex="-1" role="dialog" aria-labelledby="contribuicoesModalTitle" aria-hidden="true">
    <?php include('modal_contribuicoes.php');?>
</div>




    <?php } ?>