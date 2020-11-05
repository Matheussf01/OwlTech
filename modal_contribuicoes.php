<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="contribuicoesModal">Contribuições</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">


      <div class="muck-up">
        <div class="bottom">
          <ul class="tasks-colaborador">

            <?php

            if ($_SESSION['deficiencia'] == 0) { 
              $query = (' SELECT u.*, s.* FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado WHERE id_contribuinte = ' . $_SESSION['id'] . ' AND dt_conclusao is not NULL ORDER BY dt_conclusao desc');
            }else{
              $query = (' SELECT u.*, s.* FROM solicitacao s JOIN usuarios u ON u.id_usuario = s.id_beneficiado WHERE id_beneficiado = ' . $_SESSION['id'] . ' AND dt_conclusao is not NULL ORDER BY dt_conclusao desc');
            }
            $result = mysqli_query($conn, $query) or die("erro ao selecionar");

            while ($rstTemp = mysqli_fetch_array($result)) {

             $dt_solicitacao= date_create($rstTemp['dt_solicitacao']);
             $dt_solicitacao= date_format($dt_solicitacao, 'd/m/Y H:i');

             $dt_conclusao= date_create($rstTemp['dt_conclusao']);
             $dt_conclusao= date_format($dt_conclusao, 'd/m/Y H:i');

              echo '<li class=" historico d-flex">
                    <div class="historico">
                       <p><strong>Nome:</strong> <span>'.$rstTemp['nome'].'</span></p>
                       <p><strong>Localização:</strong> <span>'.$rstTemp['localizacao'].'</span></p>';
                        if($rstTemp['destino'] != ""){
                            echo('  <p><strong>Destino:</strong> <span>'.$rstTemp['destino'].'</span></p>');
                        }
                        echo'<span class="task-title">' . $rstTemp['tarefa'] . '</span>
                        <span class="task-cat">' . $dt_solicitacao . '  ->  ' . $dt_conclusao. '</span>
                        <hr/>
                    </div>
                </li>';



              
            }
            ?>

          </ul>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-secondary" data-dismiss="modal">Fechar</a>
    </div>
  </div>
</div>