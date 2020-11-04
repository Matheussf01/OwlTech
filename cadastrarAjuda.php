<?php
session_start(); 
include("connect.php");

if(isset($_POST['ajudar'])){

   
    $colaborador= $_SESSION['id'];
    $idsolicitacao= $_POST['idsolicitacao'];



        
    $query = ('UPDATE solicitacao SET id_contribuinte = '.$colaborador.' WHERE id_solicitacao = '.$idsolicitacao.';');
    $update = mysqli_query($conn, $query);

        if($update){
            echo('<script>window.alert("Parabéns! Alguém está ancioso te esperando!!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
        }
    else  if($update){
        echo('<script>window.alert("Infelizmente algo deu errado, tente novamente!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
    }


}

?>