  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recompensasModal">Recompensas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="reward-modal-body">
        <div class="image-reward-box">
          <img class="flip-scale-up-hor" src="images/reward.png" alt="Reward">
        </div>

        <div class="box-rewards">

        <?php
         

          $query = ('select * from recompensa where pontuacao <= (select pontuacao from usuarios where id_usuario='.$_SESSION['id'].')');
          $result = mysqli_query($conn, $query) or die("erro ao selecionar");
          if (mysqli_num_rows($result)>0){
            while ($rstTemp = mysqli_fetch_array($result)) {

              echo'<div class="box">
                    <h3>'.$rstTemp['nome'].'</h3>
                      <div class="image-reward-box">
                        <img class="scale-up-center" src="'.$rstTemp['imagem'].'">
                      </div>
                      <div class="pontos">
                        <p>'.$rstTemp['pontuacao'].' pontos</p>
                        <a class="resgatar" href="#">Resgatar</a>
                      </div>
                    </div>
                  ';
            }
          }else{
            echo'Utilize a nossa plataforma e acumule pontos!';
          }
        ?>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-secondary" data-dismiss="modal">Fechar</a>
      </div>
    </div>
  </div>