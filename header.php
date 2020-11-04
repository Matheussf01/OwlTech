
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
                        echo('<img src="'.$_SESSION['foto_perfil'].'">');
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

                    <?php 

                        $query_select = ('select  nome, deficiencia_tipo, email, deficiencia, foto_perfil from usuarios WHERE id_usuario ='. $_SESSION['id']);
                        $resultado = mysqli_query($conn, $query_select) or die("erro ao selecionar");
                        $rstTemp=mysqli_fetch_array($resultado);

                        $deficiencia="";
                        if($rstTemp['deficiencia']==1){
                            $deficiencia = $rstTemp['deficiencia_tipo'];
                        }
                        
                        echo('
                        <form action="alterarFoto.php" method="POST" class="image-perfil" enctype="multipart/form-data">
                            <div class="nav-link img-perfil mr-3">
                                <img src="'.$rstTemp['foto_perfil'].'">
                                
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
                        <form action="#" method="POST">
                            <div>
                                <label class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="recipient-name" value="'.$rstTemp['nome'].'">
                            </div>
                            <div>
                                <label class="col-form-label">Alterar Senha?</label>
                                <input type="checkbox" name="alterasenha" value="true" id="myCheck" onclick="showCheckbox()">
                                <input id="text" class="form-control" name="senha" id="recipient-name" style="display:none" placeholder="Digite a nova senha...">

                            </div>
                            <div>
                                <label class="col-form-label">E-mail:</label>
                                <input type="text" class="form-control" name="email" id="recipient-name" value="'.$rstTemp['email'].'">
                            </div>
                            <div class="field question" value="">
                                <p>Tem alguma Deficiência?</p>
                                <select name="deficiencia" id="">');
                               
                                $selectDeficiencia = ('SELECT nome FROM deficiencia ORDER BY id_deficiencia ASC');

                                $deficiencias = mysqli_query($conn, $selectDeficiencia) or die("erro ao selecionar");
                               
                                while($rstTempdeficiencias=mysqli_fetch_array($deficiencias)){
                                    
                                     $selected="";
                                     $listDeficiencia = $rstTempdeficiencias['nome'];
                                     $listDeficiencia = utf8_encode($listDeficiencia);

                                    if($listDeficiencia == $rstTemp['deficiencia_tipo']){
                                        $selected="selected";
                                    }
                                    echo'<option value="'.$listDeficiencia.'" '.$selected.'>'.$listDeficiencia.'</option>';

                                }
                               
                            
                                echo('</select>
                            </div>
                            <input type="submit" name="alterarDados"  value="Salvar">
                        </form>
                        '); ?>
                        
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar </button>
                  
                   
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
    <?php


    if(isset($_POST['alterarDados'])){

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        
        $senha="";
        if(isset($_POST['alterasenha'])){
            $senha = 'senha = "'. md5($_POST['senha']).'",';
            
        }
       
        $deficienciaTipo = $_POST['deficiencia'];
        $deficiencia = 1;

        if($deficienciaTipo == "Não"){
            $deficiencia = 0;
        }
    

        $query = (' UPDATE usuarios SET nome = "'.$nome.'" ,  '.$senha.' deficiencia_tipo = "'.$deficienciaTipo.'" , email = "'.$email.'" , deficiencia = '.$deficiencia.' WHERE id_usuario ='.$_SESSION['id'] );
        $update = mysqli_query($conn, $query);
    
        if($update){

            $_SESSION['nome'] = $nome;
            $_SESSION['deficiencia'] = $deficiencia;
          
            echo('<script>window.alert("Dados alterados!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
        }
        else
        {
            echo('<script>window.alert("Erro ao alterar os dados!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
        }

        
    }

} 


?>