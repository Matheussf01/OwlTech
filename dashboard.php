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

    <h1>DASHBOARD</h1>
    <hr>
    <div class="grafico">
      <div>
        <h2>Histórico de usabilidade</h2>
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>
      
      <div>
        <h2>Usuários</h2>
        <canvas id="pie" width="400" height="400"></canvas>
      </div>
    </div>


    <script src="js/dashboard.js" type="text/javascript"></script>

</body>
</html>