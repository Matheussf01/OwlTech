
    <?php
     session_start(); 
     include("connect.php");

        if(isset($_POST['alterarFoto'])){
            
                $foto=$_FILES['image']['tmp_name'];
                $tamanho_permitido = 10048000; //10 MB
                $pasta='upload';
                
                if(!empty($foto))
                {
                    $file = getimagesize($foto);

                    //TESTA O TAMANHO DO ARQUIVO
                    if($_FILES['image']['size'] > $tamanho_permitido)
                    {
                        echo('<script>window.alert("erro - arquivo muito grande!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
                        exit();
                    }

                    //TESTA A EXTENSÃO DO ARQUIVO
                    if(!preg_match('/^image\/(?:gif|jpg|jpeg|png)$/i', $file['mime']))
                    {
                        
                        echo('<script>window.alert("erro - extensão não permitida!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
                        exit();
                    }

                    //CAPTURA A EXTENSÃO DO ARQUIVO
                    $extensao = str_ireplace("/", "", strchr($file['mime'], "/"));

                    //MONTA O CAMINHO DO NOVO DESTINO
                    $novoDestino = $pasta.'/'.uniqid('', true).'.'.$extensao;  
                    move_uploaded_file ($foto , $novoDestino );
                    
                    echo $novoDestino;
                    $sqlcode=('update usuarios set foto_perfil="'.$novoDestino.'" where id_usuario='.$_SESSION['id'].';');
                    mysqli_query($conn,$sqlcode);

                    
                    $_SESSION['foto_perfil'] = $novoDestino;
                    echo('<script>window.alert("Foto alterada!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
                }
                else
                {
                    echo('<script>window.alert("Escolha um arquivo!"); window.location="'.$_SESSION["paginaAtual"] .'";</script>');
                }
            }
         
        
    ?>