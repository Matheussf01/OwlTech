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
    <link rel="stylesheet" href="css/portal-colaborador.css">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
        <a class="navbar-brand" href="index.php">
            <img src="images/owlbility.png" alt="logo Dow">
        </a>
        <div class="d-flex align-items-center">
            <div class="itens-menu">
                <a href="#" onclick='abreContribuicoes()' > Contribuições </a>
            </div>
            <div>
                <a class="nav-link  img-perfil d-flex align-items-center justify-content-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php 
                      echo('<img src="'.$usuario_info['foto_perfil'].'">');
                    ?>
                   
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#perfilModal">Perfil</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#faleConoscoModal">Fale Conosco</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="sair.php">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="sides container d-flex align-items-center">
        <div class="row col-12 align-items-center">
            <div class="col-md-6">
                <div>
                    <h1 class="title-bemvindo">Olá,</h1>
                    <h1 class="title-bemvindo-name"><?php echo($_SESSION['nome']);?></h1>
                    <h1 class="title-bemvindo">Vamos ajudar quem hoje?</h1>

                </div>
                <!-- <div>
                    <a class="btn-solicitar">Solicitar ajuda</a>
                </div> -->
                <div class="box-andamento-solicitacao">

                </div>


            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <div class=" box-historico">
                    <div class="muck-up">
                        <div class="bottom">
                            <ul class="tasks-colaborador">

                            <?php
                            
                                $query_select = ('SELECT u.nome, u.foto_perfil, u.registro, s.id_solicitacao, s.tarefa ,s.dt_solicitacao FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado ');

                                $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
                                while($rstTemp=mysqli_fetch_array($sqlresult)){
                                    echo'
                                    <li class=" historico d-flex">
                                        <div class="img-perfil-tasks d-flex align-items-center justify-content-center">
                                         <img src="'.$usuario_info['foto_perfil'].'">
                                        </div>
                                        <div class="tasks-box-conteudo d-flex">
                                            <div>
                                                <span class="task-title">'.$rstTemp['nome'].'</span>
                                                <span class="task-cat">'.$rstTemp['tarefa'].'</span>
                                            </div>
                                            <div>
                                            <span class="task-time"> 
                                                 <button type="button" class="btn-solicitar" data-solicitacao="'.$rstTemp['id_solicitacao'].'"  data-toggle="modal" data-target="#contribuicoes">
                                                    Ajudar
                                                </button>
                                              </span>
                                            </div>
                                        </div>
                                    </li>';
                                }
                               

                            ?>

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
                <p>Siga nossas redes sociais</p>
                <div>
                    <a href=""><img src="images/insta.png" /></a>
                    <a href=""><img src="images/face.png" /></a>
                    <a href=""><img src="images/twitter.png" /></a>
                </div>

            </div>
        </div>
    </div>

 

    <div class="modal fade" id="contribuicoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Parabéns! Ajude!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>

        <script type="text/javascript">
           
                    
            $( ".btn-solicitar" ).click(function() {

                var solicitacao = $(this).attr("data-solicitacao");

                pacote = {
                    solicitacao: solicitacao
                };
               
                $.ajax({
                    method: 'POST',
                    url: 'modal_ajudar.php',
                    data: pacote
                }).done(function (dados) {            
                        $('.modal-body').html(dados);
                    
                    });

            });
        </script>                   




</body>

</html>

<?php
    }
?>