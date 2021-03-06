<?php
session_start();
include("connect.php");


if (empty($_SESSION['id']) || $_SESSION['deficiencia'] == 1) {
  /*verifica se existem as informações*/
  session_destroy();
  header('location:index.php');
} else {

  $uri = $_SERVER["REQUEST_URI"];
  $uriArray = explode("/", $uri);
  $_SESSION["paginaAtual"] = end($uriArray);


?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/modal_recompensas.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/portal-colaborador.css">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  </head>

  <body>

    <?php include('header.php'); ?>

    <div class="container main">
      <div class="row col-12 align-items-center">



        <div class="boxes mt-5">

          <div class="d-flex align-items-center">
            <div>
              <h1 class="title-bemvindo">Olá,</h1>
              <h1 class="title-bemvindo-name"><?php echo ($_SESSION['nome']); ?></h1>
              <h1 class="title-bemvindo">Vamos ajudar quem hoje?</h1>
            </div>
          </div>

          <div class="box-historico">
            <div class="muck-up">
              <div class="bottom">
                <ul class="tasks-colaborador">



                  <?php
                  $verificandoSolicitacoes = ('SELECT s.*, u.* FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado WHERE s.id_contribuinte = ' . $_SESSION['id'] . ' AND s.dt_conclusao IS NULL ORDER BY s.id_solicitacao DESC;');

                  $testa = mysqli_query($conn, $verificandoSolicitacoes) or die("erro ao selecionar");

                  if (mysqli_num_rows($testa) > 0) {

                    $rstTemp = mysqli_fetch_array($testa);


                    if ($rstTemp['dt_agendamento'] == "") {
                      $dt_agendamento = "Não";
                    } else {

                      $dt_agendamento = date_create($rstTemp['dt_agendamento']);
                      $dt_agendamento = "Sim, " . date_format($dt_agendamento, 'd/m/Y H:i:s');
                    }

                    echo '<li class="box-andamento-solicitacao">
                        <h4>Solicitação em Andamento</h4>
                        <hr>
                        <p><strong>Nome:</strong> <span>' . $rstTemp['nome'] . '</span></p>
                        <p><strong>Localização atual:</strong> <span>' . $rstTemp['localizacao'] . '</span></p>';
                    if ($rstTemp['destino'] != "") {
                      echo ('  <p><strong>Destino:</strong> <span>' . $rstTemp['destino'] . '</span></p>');
                    }
                    echo '<p><strong>Horário Agendado:</strong> <span>' . $dt_agendamento . '</span></p>
                        <p><strong>Tarefa a ser realizada:</strong> <span>' . $rstTemp['tarefa'] . '</span></p>
                        <p><strong>Descrição:</strong> <span>' . $rstTemp['descricao'] . '</span></p>

                        <form action="concluirSolicitacao.php" method="POST">
                            <input type="text" class="d-none" name="idsolicitacao" value="' . $rstTemp['id_solicitacao'] . '">
                            <input class="btn-red" type="submit" name="concluiSolicitacao" value="Concluir">
                        </form>
                    </li> ';
                  } else {

                    $query_select = ('SELECT u.nome, u.foto_perfil, u.registro, s.id_solicitacao, s.tarefa, s.dt_solicitacao, s.id_contribuinte, s.dt_conclusao FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado WHERE s.id_contribuinte IS NULL AND s.dt_conclusao IS NULL ORDER BY s.id_solicitacao DESC;');

                    $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
                    if (mysqli_num_rows($sqlresult) > 0) {
                      while ($rstTemp = mysqli_fetch_array($sqlresult)) {
                        echo '
                                <li class=" historico d-flex">
                                        <div class="img-perfil-tasks d-flex align-items-center justify-content-center">
                                            <img src="' . $rstTemp['foto_perfil'] . '">
                                        </div>
                                        <div class="tasks-box-conteudo d-flex">
                                                <div>
                                                        <span class="task-title">' . $rstTemp['nome'] . '</span>
                                                        <span class="task-cat">' . $rstTemp['tarefa'] . '</span>
                                                </div>
                                                <div>
                                                <span class="task-time"> 
                                                            <button type="button" class="btn-solicitar" data-solicitacao="' . $rstTemp['id_solicitacao'] . '"  data-toggle="modal" data-target="#contribuicoes">
                                                                Ajudar
                                                        </button>
                                                    </span> 
                                                </div>
                                        </div>
                                </li>';
                      }
                    } else {
                      echo 'Nenhuma solicitação aberta.';
                    }
                  }


                  ?>

                </ul>
              </div>
            </div>
          </div>
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
          <div class="modal-body modal-body-ajudarColaborador">


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <?php include('hand_talk.php'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(".btn-solicitar").click(function() {

        var solicitacao = $(this).attr("data-solicitacao");

        pacote = {
          solicitacao: solicitacao
        };

        $.ajax({
          method: 'POST',
          url: 'modal_ajudar.php',
          data: pacote
        }).done(function(dados) {
          $('.modal-body-ajudarColaborador').html(dados);

        });

      });
    </script>




  </body>

  </html>

<?php
}
?>