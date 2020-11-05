<?php
session_start(); 
include("connect.php");

if(isset($_POST['excluir'])){

   
    $idsolicitacao= $_POST['idsolicitacao'];
    
    $query = ('DELETE FROM solicitacao WHERE id_solicitacao = '.$idsolicitacao.'; ');
    $delete = mysqli_query($conn, $query);

        if($delete){
            echo('<script>window.alert("Solicitação excluida!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
        }
    else {
        echo('<script>window.alert("Infelizmente algo deu errado, tente novamente!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
    }

}

?>