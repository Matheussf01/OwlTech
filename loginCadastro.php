<?php
session_start(); 
include("connect.php");

if(isset($_POST['login'])){
    

    $registro = $_POST['id'];
    $senha = md5($_POST['senha']);
   
        $query_select = ('select * from usuarios WHERE registro = '.$registro.' and senha = "'.$senha.'"');
       //echo $query_select;
        $verifica = mysqli_query($conn, $query_select) or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
            echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location
            .href='index.php';</script>";
            die();
        }else{
            $rstTemp=mysqli_fetch_array($verifica);
            setcookie("login",$registro);
            //echo $rstTemp['nome'];
            $_SESSION['registro'] = $registro;
            $_SESSION['id'] = $rstTemp['id_usuario'];
            $_SESSION['nome'] = $rstTemp['nome'];
            $_SESSION['deficiencia'] = $rstTemp['deficiencia'];
            $_SESSION['foto_perfil'] = $rstTemp['foto_perfil'];



            if( $rstTemp['deficiencia'] != 0){
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
     $deficiencia=1;

     if($deficienciaTipo == "n")
     {
         $deficiencia = 0;
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
            
          
                echo"<script language='javascript' type='text/javascript'>
                alert('Usuário cadastrado com sucesso!');window.location.
                href='index.php'</script>";
         

        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location.
          href='index.php'</script></script>";
          //window.location.href='index.php'
        }
      }
    }



}else{
    echo"<script language='javascript' type='text/javascript'>
    alert('Erro');window.location
    .href='index.php';</script>";
}





