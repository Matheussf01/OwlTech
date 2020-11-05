<?php
session_start(); 
include("connect.php");

if(isset($_POST['concluiSolicitacao'])){

   
    $idsolicitacao= $_POST['idsolicitacao'];

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');
 


    $query = ('UPDATE solicitacao SET dt_conclusao = "'. $date .'" WHERE id_solicitacao = '.$idsolicitacao.';');
    $update = mysqli_query($conn, $query);

        if($update){
            echo('<script>window.alert("Parabéns! Você Acaba de ganhar +5 pontos!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
        }
    else  if($update){
        echo('<script>window.alert("Infelizmente algo deu errado, tente novamente!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
    }

}

?>