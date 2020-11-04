
    

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
           

            $query = (' SELECT * FROM solicitacao WHERE id_contribuinte = '.$_SESSION['id'].' AND dt_conclusao <> NULL ORDER BY dt_conclusao desc');

            $result = mysqli_query($conn, $query) or die("erro ao selecionar");
           
            while($rstTemp=mysqli_fetch_array($result)){

                echo '<li class=" historico d-flex">
                    <div class="tasks-box-conteudo">
                        <span class="task-title">'.$rstTemp['tarefa'].'</span>
                        <span class="task-cat">'.$rstTemp['dt_solicitacao'].'&nbsp;-&nbsp;'.$rstTemp['dt_concluida'].'</span>
                    </div>
                </li>';
            }
            ?>

        </ul>
    </div>
</div>
      </div>
      <div class="modal-footer">
        <a href="#" data-dismiss="modal">Fechar</a>
      </div>
    </div>
  </div>