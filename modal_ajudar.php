<?php
    include('connect.php');
    if($_POST["solicitacao"]){
         $solicitacao = $_POST["solicitacao"];


        $query_select = ('SELECT');
        $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
        $rstTemp=mysqli_fetch_array($sqlresult);

        if($rstTemp['dt_agendamento'] == ""){
            $dt_agendamento= "Não";
        }else{
            $dt_agendamento= "Sim, ".$rstTemp['dt_agendamento'];
        }

        echo(' <div class="col-12 d-flex">
                <p>
                    <b>Nome:</b>
                </p>
                <p>&nbsp;'.$rstTemp['nome'].'</p>
            </div>
            <div class="col-12 d-flex">
                <p>
                    <b>Localização:</b>
                </p>
                <p>&nbsp;'.$rstTemp['localizacao'].'</p>
            </div>
            <div class="col-12 d-flex">
                <p>
                    <b>Horário Agendado?</b>
                </p>
                <p>&nbsp;'.$dt_agendamento.'</p>
            </div>
            <div class="col-12 d-flex">
                <p>
                    <b>Tarefa a ser realizada:</b>
                </p>
                <p>&nbsp;'.$rstTemp['tarefa'].'</p>
            </div>');

            if($rstTemp['destino'] != ""){
                echo(' <div class="col-12 d-flex">
                <p>
                    <b>Destino</b>
                </p>
                <p>&nbsp;'.$rstTemp['destino'].'</p>
            </div>');
            }
           

            echo('<div class="col-12 d-flex">
                <p>
                    <b>Descrição:</b>
                </p>
                <p>&nbsp;'.$rstTemp['descricao'].'</p>
            </div>

            <div class="col-12 d-flex">
                <form action="cadastrarAjuda.php" method="POST">
                    <input type="text" class="d-none" name="beneficiado" value="'.$rstTemp['id_beneficiario'].'">
                    <input type="submit" name="ajudar" value="Ajudar">
                </form>
            </div> ');

    }
?>
                
