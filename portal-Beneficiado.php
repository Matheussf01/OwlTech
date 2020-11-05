<?php
session_start();
include("connect.php");

if (empty($_SESSION['id']) || $_SESSION['deficiencia'] == 0) {
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
    <link rel="stylesheet" href="css/portal-beneficiado.css">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

  </head>

  <body>

    <?php include('header.php'); ?>


    <div class="sides container d-flex align-items-center">
      <div class="row col-12 align-items-center">
        <div class="col-md-6">
          <div>
            <h1 class="title-bemvindo">Bem vindo,</h1>
            <h1 class="title-bemvindo-name"><?php echo ($_SESSION['nome']); ?></h1>
          </div>
          <div>
            <a class="btn-solicitar" data-toggle="modal" data-target="#solicitar-ajuda">Solicitar ajuda</a>
          </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center mt-5">
          <div class=" box-historico">
            <h2 class="titulo-historico">Solicitações em Andamento</h2>
            <div class="muck-up">
              <div class="bottom">
                <ul class="tasks">

                  <?php
                   $verificandoSolicitacoes = ('SELECT * FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado WHERE s.id_beneficiado = '.$_SESSION['id'].' AND s.dt_conclusao IS NULL ORDER BY s.id_solicitacao DESC;');
                    
                   $testa = mysqli_query($conn, $verificandoSolicitacoes) or die("erro ao selecionar");
                   
                   if (mysqli_num_rows($testa)>0){
                       
                    while ($rstTemp = mysqli_fetch_array($testa)) {
                        

                        $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
                        
                        if($rstTemp['dt_agendamento'] == ""){
                            $dt_agendamento= "Não";
                        }else{
                        
                            $dt_agendamento= date_create($rstTemp['dt_agendamento']);
                            $dt_agendamento= "Sim, ". date_format($dt_agendamento, 'd/m/Y H:i:s');
                
                        }

                        echo '<li class="box-andamento-solicitacao">
                     
                    
                        <p><strong>Localização:</strong> <span>'.$rstTemp['localizacao'].'</span></p>';
                        if($rstTemp['destino'] != ""){
                            echo('  <p><strong>Destino:</strong> <span>'.$rstTemp['destino'].'</span></p>');
                        }
                        echo '<p><strong>Horário Agendado:</strong> <span>'.$dt_agendamento.'</span></p>
                        <p><strong>Tarefa a ser realizada:</strong> <span>'.$rstTemp['tarefa'].'</span></p>
                        <p><strong>Descrição:</strong> <span>'.$rstTemp['descricao'].'</span></p>
                        <div class="d-flex">
                        <form action="concluirSolicitacao.php" method="POST">
                            <input type="text" class="d-none" name="idcontribuinte" value="'.$rstTemp['id_contribuinte'].'">
                            <input type="text" class="d-none" name="idsolicitacao" value="'.$rstTemp['id_solicitacao'].'">';
                            if($rstTemp['id_contribuinte'] != ""){
                                echo'<input type="submit" name="concluiSolicitacao" value="Concluir">';
                            }
                        echo'</form>
                            <form action="excluirSolicitacao.php" method="POST">
                                <input type="text" class="d-none" name="idsolicitacao" value="'.$rstTemp['id_solicitacao'].'">
                                <input type="submit" class="btn" name="excluir" value="Excluir">
                            </form>    
                        </div>
                        <hr>
                    </li> ';  
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
    <div class="modal fade" id="solicitar-ajuda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <?php include('modal_solicitar.php'); ?>


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