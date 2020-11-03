<?php
session_start(); 
include("connect.php");

if(isset($_POST['login'])){
    

    $id = $_POST['id'];
    $senha = md5($_POST['senha']);
   
        $query_select = ('select * from usuarios WHERE registro = '.$id.' and senha = "'.$senha.'"');
       //echo $query_select;
        $verifica = mysqli_query($conn, $query_select) or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
            echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location
            .href='index.php';</script>";
            die();
        }else{
            $rstTemp=mysqli_fetch_array($verifica);
            setcookie("login",$id);
            //echo $rstTemp['nome'];
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $rstTemp['nome'];
            $_SESSION['deficiencia'] = $rstTemp['deficiencia'];

            if( $rstTemp['deficiencia'] != ""){
                header("Location:portal-Beneficiado.php");
            }else{
               header("Location:portal-Colaborador.php");
            }
        }
  

}else if(isset($_POST['cadastrar'])){
    
     $id = $_POST['id'];
     $senha = md5($_POST['senha']);
     $nome = $_POST['nome'];
     $email = $_POST['email'];
     $deficienciaTipo = $_POST['deficiencia'];
     $deficiencia=TRUE;

    if($deficienciaTipo == "")
    {
        $deficiencia = FALSE;
        $deficienciaTipo = NULL;
    }
  

  if($id == "" || $id == null || $senha  == "" || $senha == null || $nome  == ""  || $nome == null || $email  == ""  || $email == null ){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";
   
    }else{
        

        $query_select = ('select * from usuarios WHERE registro = '.$id.' and senha = "'.$senha.'"');
        //echo $query_select;
        $verifica = mysqli_query($conn, $query_select) or die("erro ao selecionar");

        if (mysqli_num_rows($verifica)>0){
           

            echo"<script language='javascript' type='text/javascript'>
            alert('Esse login já existe');window.location.href='index.php';</script>";
           

      }else{
    

        $query = 'insert into usuarios (registro, senha, nome, deficiencia, deficiencia_tipo, email) VALUES ('.$id.',"'.$senha.'","'.$nome.'","'.$deficiencia.'","'.$deficienciaTipo.'","'.$email.'")';
        $insert = mysqli_query($conn, $query);
       
        if($insert){
            
            if($deficiencia == FALSE){
                echo"<script language='javascript' type='text/javascript'>
                alert('Usuário cadastrado com sucesso!');window.location.
                href='portal-Beneficiado.php'</script>";
            }else{
                echo"<script language='javascript' type='text/javascript'>
                alert('Usuário cadastrado com sucesso!');window.location.
                href='portal-Colaborador.php'</script>";
            }


        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');</script>";
          //window.location.href='index.php'
        }
      }
    }



}else{
    echo"<script language='javascript' type='text/javascript'>
    alert('Erro');window.location
    .href='index.php';</script>";
}





