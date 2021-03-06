<?php

if (empty($_SESSION['id'])) {
  /*verifica se existem as informações*/
  session_destroy();
  header('location:index.php');
} else {

?>

  <div class="header-nav">
    <nav class="navbar navbar-expand-lg  d-flex justify-content-around">
      <a class="navbar-brand" href="index.php">
        <img class="owlbility" src="images/owlbility.png" alt="logo Dow">
        <img class="logoImage" src="images/logoImage.png" alt="logo Dow">
      </a>
      <div class="d-flex align-items-center">


        <div class="itens-menu d-flex">

          <a href="#" data-toggle="modal" data-target="#contribuicoesModal" onclick='abreContribuicoes()'> Histórico </a>
          <a href="#" data-toggle="modal" data-target="#recompensasModal"> Recompensas </a>
          

        </div>



        <div>
          <a class="nav-link  img-perfil d-flex align-items-center justify-content-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
            echo ('<img src="' . $_SESSION['foto_perfil'] . '">');
            ?>

          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="dropdown-item exibPontuacao" >
            <?php
            
            $query_select = ('select pontuacao from usuarios WHERE id_usuario =' . $_SESSION['id']);
            $resultado = mysqli_query($conn, $query_select) or die("erro ao selecionar");
          
            while ($rstTemp = mysqli_fetch_array($resultado)) {
                echo $rstTemp['pontuacao'].' pontos';
            }
          ?>
            </div>
            <a class="dropdown-item" id="editPerfil" href="#" data-toggle="modal" data-target="#perfilModal">Perfil</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#faleConoscoModal">Fale Conosco</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="sair.php">Sair</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <div class="form-group">

            <?php

            $query_select = ('select * from usuarios WHERE id_usuario =' . $_SESSION['id']);
            $resultado = mysqli_query($conn, $query_select) or die("erro ao selecionar");
            $rstTemp = mysqli_fetch_array($resultado);

            $deficiencia = "";
            if ($rstTemp['deficiencia'] == 1) {
              $deficiencia = $rstTemp['deficiencia_tipo'];
            }

            echo ('
              <form action="alterarFoto.php" method="POST" class="image-perfil" enctype="multipart/form-data">
                  <div class="nav-link img-perfil mr-3">
                      <img src="' . $rstTemp['foto_perfil'] . '">
                      
                  </div>
                  <div>
                    <div class="alteracao-foto mt-2">
                      <div class="button-wrapper-img">
                        <span class="label">
                            Escolha uma imagem
                        </span>
                        <input type="file" name="image" id="upload" class="upload-box" placeholder="Upload File">
                      </div>
                        <input class="alterar" type="submit" name="alterarFoto" class="btn" value="Alterar Foto">
                      </div>
                  </div>
              </form>
              <form action="#" method="POST">
                  <div class="campo">
                      <label class="col-form-label">Nome:</label>
                      <input type="text" class="form-control" name="nome" id="recipient-name" value="' . $rstTemp['nome'] . '">
                  </div>
                  <div class="campo">
                      <label class="col-form-label">Alterar Senha?</label>
                      <input type="checkbox" name="alterasenha" value="true" id="myCheck" onclick="showCheckbox()">
                      <input type="text" class="form-control" name="senha" id="input-check" style="display:none" placeholder="Digite a nova senha...">

                  </div>
                  <div class="campo">
                      <label class="col-form-label">E-mail:</label>
                      <input type="text" class="form-control" name="email" id="recipient-name" value="' . $rstTemp['email'] . '">
                  </div>
                  <div class="field question campo" value="">
                      <p>Tem alguma Deficiência?</p>
                      <select name="deficiencia" id="">');

            $selectDeficiencia = ('SELECT nome FROM deficiencia ORDER BY id_deficiencia ASC');

            $deficiencias = mysqli_query($conn, $selectDeficiencia) or die("erro ao selecionar");

            while ($rstTempdeficiencias = mysqli_fetch_array($deficiencias)) {

              $selected = "";
              $listDeficiencia = $rstTempdeficiencias['nome'];
              $listDeficiencia = utf8_encode($listDeficiencia);

              if ($listDeficiencia == $rstTemp['deficiencia_tipo']) {
                $selected = "selected";
              }
              echo '<option value="' . $listDeficiencia . '" ' . $selected . '>' . $listDeficiencia . '</option>';
            }


            echo ('</select>
                      </div>
                      <input class="btn-red" type="submit" name="alterarDados"  value="Salvar">
                    </form>
                  '); ?>

          </div>

        </div>

        <div class="modal-footer">
          <a href="#" class="btn btn-secondary" data-dismiss="modal">Fechar</a>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="recompensasModal" tabindex="-1" role="dialog" aria-labelledby="recompensasModalTitle" aria-hidden="true">
    <?php include('modal_recompensas.php'); ?>
  </div>

  <div class="modal fade" id="contribuicoesModal" tabindex="-1" role="dialog" aria-labelledby="contribuicoesModalTitle" aria-hidden="true">
    <?php include('modal_contribuicoes.php'); ?>
  </div>

  <div class="modal fade" id="faleConoscoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include('modal_faleConosco.php'); ?>
  </div>


<?php


  if (isset($_POST['alterarDados'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $senha = "";
    if (isset($_POST['alterasenha'])) {
      $senha = 'senha = "' . md5($_POST['senha']) . '",';
    }

    $deficienciaTipo = $_POST['deficiencia'];
    $deficiencia = 1;

    if ($deficienciaTipo == "Não") {
      $deficiencia = 0;
    }


    $query = (' UPDATE usuarios SET nome = "' . $nome . '" ,  ' . $senha . ' deficiencia_tipo = "' . $deficienciaTipo . '" , email = "' . $email . '" , deficiencia = ' . $deficiencia . ' WHERE id_usuario =' . $_SESSION['id']);
    $update = mysqli_query($conn, $query);
    echo $query;
    if ($update) {

      $_SESSION['nome'] = $nome;
      $_SESSION['deficiencia'] = $deficiencia;

      echo ('<script>window.alert("Dados alterados!"); window.location="' . $_SESSION["paginaAtual"] . '";</script>');
    } else {
      echo ('<script>window.alert("Erro ao alterar os dados!"); window.location="' . $_SESSION["paginaAtual"] . '";</script>');
    }
  }
}


?>