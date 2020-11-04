<?php
    session_start(); 
    include("connect.php");

  

    if( empty($_SESSION['id']) || $_SESSION['deficiencia'] == 0)
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

        
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/portal.css">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>

    <?php include('header.php');?>

    
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
    <!-- <div class="social-media d-flex align-items-center ">
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
    </div> -->

    <!-- ================================ -->
    <!-- MODAL AREA -->
    <!-- ================================ -->

    <!-- Button trigger modal -->

    <!-- Modal PERFIL-->

    <!-- MODAL FALE CONOSCO -->


    <!-- MODAL SOLICITAR AJUDA -->
    <div class="modal fade" id="solicitar-ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?php include('modal_solicitar.php');?>

        
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