<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/header.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
  <title>Document</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" type="text/javascript"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
  <main>

    <div class="titulo">
      <span>
        <h1>DASHBOARD</h1>
        <img class="dash-icon" src="images/dashboard.svg" alt="">
      </span>

      <a href="index.php">
        <img class="owlbility" src="images/owlbility.png" alt="logo Dow">
        <img class="logoImage" src="images/logoImage.png" alt="logo Dow">
      </a>
    </div>


    <div class="grafico">
      <div class="box scale-up-center">
        <h2>Alguma Coisa Top</h2>
      </div>

      <div class="box scale-up-center">
        <h2>Usuários</h2>
        <canvas id="pie" width="400" height="400"></canvas>
      </div>

      <div class="box scale-up-center">
        <h2>Histórico de usabilidade</h2>
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>

      <div class="box scale-up-center">
        <h2>Histórico Fale Conosco</h2>
        <div class="box-comments">
          <div class="img-perfil">
            <img src="images/persona.jpg">
          </div>
          <div class="info">
            <p class="task-title"><strong>Sofia Mendes</strong></p>
            <p class="task-cat">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae possimus officia vero obcaecati impedit cum!</p>
          </div>
        </div>

        <div class="box-comments">
          <div class="img-perfil">
            <img src="images/persona.jpg">
          </div>
          <div class="info">
            <p class="task-title"><strong>Sabrina Silva</strong></p>
            <p class="task-cat">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae possimus officia vero obcaecati impedit cum!</p>
          </div>
        </div>
      </div>

    </div>



    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <script src="js/dashboard.js" type="text/javascript"></script>
  </main>
  <?php include('hand_talk.php'); ?>

</body>

</html>