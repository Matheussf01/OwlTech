    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="solicitar-ajudaLabel">Solicitar Ajuda</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" method="POST">
            <div class="form-group">
              <label for="solicitarajuda-localizacao" class="col-form-label">Localização atual</label>
              <input type="text" class="form-control" name="localizacao" id="solicitarajuda-localizacao" required>
            </div>
            <div class="form-group">
              <label for="solicitarajuda-Agendar" class="col-form-label">Agendar horário?</label>
              <input type="checkbox" name="agendarhorario" value="true" id="myCheck2" onclick="showCheckbox2()">
              <input type="datetime-local" class="form-control" name="datetime" id="input-check2" style="display:none">

            </div>
            <div class="form-group">
              <label for="solicitarajuda-tarefa" class="col-form-label">Tarefa a ser realizada:</label>
              <select name="tarefa" id="solicitarajuda-tarefa">
                <option value="Deslocamento interno (empresa)">Deslocamento interno (empresa)</option>
                <option value="Deslocamento externo (arredores)">Deslocamento externo (arredores)</option>
                <option value="Deslocar equipamentos">Deslocar equipamentos</option>
                <option value="Buscar objetos/documentos">Buscar objetos/documentos</option>
                <option value="Auxilio com tarefas manuais">Auxilio com tarefas manuais</option>



              </select>
            </div>
            <div class="form-group">
              <label for="solicitarajuda-destino" class="col-form-label">Destino</label>
              <input type="text" class="form-control" name="destino" id="solicitarajuda-destino">
            </div>
            <div class="form-group">
              <label for="solicitarajuda-descricao" class="col-form-label">Descrição</label>
              <textarea class="form-control" name="descricao" id="solicitarajuda-descricao"></textarea>
            </div>

            <div class="button-wrapper">
              <span class="label">
                <input class="finalizar-solicitar" type="submit" name="solicitar" value="Solicitar">
              </span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

        </div>
      </div>
    </div>

    <?php
    if (isset($_POST['solicitar'])) {

      $localizacao = $_POST['localizacao'];
      $tarefa = $_POST['tarefa'];

      $agendarhorario = "";
      if (isset($_POST['agendarhorario'])) {
        $agendarhorario =  $_POST['datetime'];

        $arrayAgendamento = explode("T", $agendarhorario);

        $agendarhorarioExt = '"' . $arrayAgendamento[0] . ' ' . $arrayAgendamento[1] . ':00",';


        $columAgendamento = "dt_agendamento,";
      }
      $destino = $_POST['destino'];
      $descricao = $_POST['descricao'];



      $query = ('INSERT INTO solicitacao (id_beneficiado, ' . $columAgendamento . ' descricao, tarefa, localizacao, destino) values (' . $_SESSION['id'] . ',' .  $agendarhorarioExt . ' "' . $descricao . '", "' . $tarefa . '", "' . $localizacao . '", "' . $destino . '");');



      $update = mysqli_query($conn, $query);

      if ($update) {


        echo ('<script>window.alert("Solicitação em aberto!"); window.location="' . $_SESSION["paginaAtual"] . '";</script>');
      } else {
        echo ('<script>window.alert("Erro ao cadastrar a sua solicitação!"); window.location="' . $_SESSION["paginaAtual"] . '";</script>');
      }
    }
    ?>