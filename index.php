<?php
session_start();
include("connect.php");
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/home.css">
  <title>OwlBillity</title>

  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>

  <div class="sides">
    <div class="side-text">
      <img src="images/logoPNG.png" alt="logo">
      <p>Give a hand to someone</p>
    </div>
    <div class="side-image">

      <div class="background-image"></div>

    </div>
  </div>

  <form action="loginCadastro.php" method="POST" class="login">
    <div class="inputs-login">
      <div class="field">
        <p>Registro:</p>
        <input type="text" name="id">
      </div>

      <div class="field">
        <p>Senha:</p>
        <input type="password" name="senha">
      </div>

      <div class="field nome">
        <p>Nome</p>
        <input type="text" name="nome">
      </div>

      <div class="field email">
        <p>E-mail</p>
        <input type="email" name="email">
      </div>

      <div class="field question">
        <p>Tem alguma Deficiência?</p>
        <?php
        $query_select = ('SELECT * FROM deficiencia ORDER BY id_deficiencia ASC');
        $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
        echo '<select name="deficiencia" id="">';
        while ($rstTemp = mysqli_fetch_array($sqlresult)) {
          echo '<option value="' . utf8_encode($rstTemp['nome']) . '">' . utf8_encode($rstTemp['nome']) . '</option>';
        }
        echo '</select>';
        ?>
      </div>

    </div>

    </div>

    <div class="button-login">
      <input type="submit" id="login" name="login" value="Login">
      <a id="register" onclick="cadastrar()">Cadastrar</a>
      <a class="voltar" onClick="window.location.reload();" style="display: none;">Voltar</a>
      <input type="submit" id="registered" name="cadastrar" value="Finalizar Cadastro">
    </div>
  </form>
  <div class="social-media">
    <!-- <p class="copy">Copy Right ©</p>
        <p>Siga nossas redes sociais:</p>
        <a href=""><img src="images/insta.png" /></a>
        <a href=""><img src="images/face.png" /></a>
        <a href=""><img src="images/twitter.png" /></a> -->
  </div>
  <?php include('hand_talk.php'); ?>

  <script src="js/home.js"></script>
</body>

</html>