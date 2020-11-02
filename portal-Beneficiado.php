<?php
    session_start(); 
    include("connect.php");

  

    if((empty($_SESSION['id'])))
    {
        /*verifica se existem as informações*/
        session_destroy();
        header('location:index.php');
    }
    else
    {

        $uri = $_SERVER["REQUEST_URI"];
        $uriArray = explode("/",$uri);
        $_SESSION["paginaAtual"] = end($uriArray);

        $sqlusuario=('select * from usuarios where registro="'.$_SESSION['id'].'";'); /*pesquisa as informações do usuario com base no email*/
        $result=mysqli_query($conn,$sqlusuario);  /*executa a query*/
        $usuario_info=mysqli_fetch_array($result);
             
        
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/portal.css">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
        <a class="navbar-brand" href="index.html">
            <img src="images/owlbility.png" alt="logo Dow">
        </a>


        <div>
            <a class="nav-link  img-perfil d-flex align-items-center justify-content-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#perfilModal">Perfil</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#faleConoscoModal">Fale Conosco</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="sair.php">Sair</a>
            </div>
        </div>

    </nav>
    <div class="sides container d-flex align-items-center">
        <div class="row col-12 align-items-center">
            <div class="col-md-6">
                <div>
                    <h1 class="title-bemvindo">Bem vindo,</h1>
                    <h1 class="title-bemvindo-name"><?php echo($_SESSION['nome']);?></h1>
                </div>
                <div>
                    <a class="btn-solicitar" data-toggle="modal" data-target="#solicitar-ajuda">Solicitar ajuda</a>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center mt-5">
                <div class=" box-historico">
                    <h2 class="titulo-historico">Histórico</h2>
                    <div class="muck-up">
                        <div class="bottom">
                            <ul class="tasks">
                                <li class=" green">
                                    <span class="task-title">Locomoção</span>
                                    <span class="task-time">Em andamento</span>
                                    <span class="task-cat">Metrô Vila Prudente</span>
                                </li>

                                <li class="historico">
                                    <span class="task-title">Transporte de Objetos</span>
                                    <span class="task-time">11/09/2020</span>
                                    <span class="task-cat">Troca de cadeira</span>
                                </li>

                                <li class=" historico">
                                    <span class="task-title">Auxilo com tarefas manuais</span>
                                    <span class="task-time">11/09/2020</span>
                                    <span class="task-cat">Organização de documentos</span>
                                </li>

                                <li class=" historico">
                                    <span class="task-title">Outros</span>
                                    <span class="task-time">11/09/2020</span>
                                    <span class="task-cat">Computador com defeito</span>
                                </li>

                                <li class=" historico">
                                    <span class="task-title">Outros</span>
                                    <span class="task-time">11/09/2020</span>
                                    <span class="task-cat">Reunião com a diretória</span>
                                </li>
                                <li class=" historico">
                                    <span class="task-title">Outros</span>
                                    <span class="task-time">11/09/2020</span>
                                    <span class="task-cat">Microsoft Teams</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="social-media d-flex align-items-center ">
        <div class="container">
            <div class="row d-flex justify-content-end">
                <p class="mr-3">Siga nossas redes sociais</p>
                <div>
                    <a href=""><img src="/images/insta.png" /></a>
                    <a href=""><img src="/images/face.png" /></a>
                    <a href=""><img src="/images/twitter.png" /></a>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL AREA -->
    <!-- ================================ -->

    <!-- Button trigger modal -->

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
                </div>
                <div class="modal-footer">
                    <a href="portal-Beneficiado.html" data-dismiss="modal">Close</a>
                    <a href="portal-Beneficiado.html" data-dismiss="modal">Salvar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FALE CONOSCO -->
    <div class="modal fade" id="faleConoscoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fale Conosco</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Assunto</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mensagem:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="portal-Beneficiado.html" data-dismiss="modal">Close</a>
                    <a href="portal-Beneficiado.html" data-dismiss="modal">Enviar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SOLICITAR AJUDA -->
    <div class="modal fade" id="solicitar-ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="solicitar-ajudaLabel">Solicitar Ajuda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                </div>
                <div class="modal-body">
                    <form>


                        <div class="form-group">
                            <label for="solicitarajuda-localizacao" class="col-form-label">Localização</label>
                            <input type="text" class="form-control" id="solicitarajuda-localizacao" required>
                        </div>
                        <div class="form-group">
                            <label for="solicitarajuda-Agendar" class="col-form-label">Agendar horário?</label>
                            <input type="checkbox" id="solicitarajuda-Agendar">
                        </div>
                        <div class="form-group">
                            <label for="solicitarajuda-tarefa" class="col-form-label">Tarefa a ser realizada:</label>
                            <select name="tarefa" id="solicitarajuda-tarefa">
                                <option value="#">Locomoção</option>
                                <option value="#">Transporte de Objetos</option>
                                <option value="#">Auxilio com tarefas manuais</option>
                                <option value="#">Outros</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="solicitarajuda-destino" class="col-form-label">Destino</label>
                            <input type="text" class="form-control" id="solicitarajuda-destino">
                        </div>
                        <div class="form-group">
                            <label for="solicitarajuda-descricao" class="col-form-label">Descrição:</label>
                            <textarea class="form-control" id="solicitarajuda-descricao"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="portal-Beneficiado.html" class="btn-fechar" data-dismiss="modal">Fechar</a>
                    <a href="portal-Beneficiado.html" data-dismiss="modal">Enviar</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="js/script.js" type="text/javascript"></script>

</body>

</html>
<?php
    }
?>