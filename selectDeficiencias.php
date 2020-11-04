<?php

    $query_select = ('SELECT * FROM deficiencia ORDER BY id_deficiencia ASC');

    $sqlresult = mysqli_query($conn, $query_select) or die("erro ao selecionar");
    echo'<select name="deficiencia" id="">';

    while($rstTemp=mysqli_fetch_array($sqlresult)){

        echo'<option value="'.$rstTemp['nome'].'">'.$rstTemp['nome'].'</option>';

    }
    echo'</select>';
?>