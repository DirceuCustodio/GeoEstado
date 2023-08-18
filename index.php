<?php
include './base/DB.class.php';
include './base/Funcoes.class.php';
include './conexao.php';
$conn = new DB();
// $id = $_GET['id'] ?? '';
/*
if($id){

  $sql = "SELECT
  uf.nome
  ,uf.sigla
  FROM uf
  ";
  

  $estados_list = $conn->get_results($sql);
}else{
  $estados_list = [];
}
*/
 


$sql_total_estados = "SELECT
 u.nome as name
, COUNT(m.nome) AS y
 FROM uf AS u
 LEFT JOIN municipios AS m ON u.id = m.uf
 GROUP BY u.id
";
 
  
  $total_estados = $conn->get_results($sql_total_estados);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    
    <?php

      // include "conexao.php";
      // $id = $_GET['id'] ?? '';
      // $sql = "SELECT * FROM uf WHERE id = $id ";

      // $dados = mysqli_query($conn, $sql,MYSQLI_USE_RESULT);

      // $linha = $dados->fetch_object();

    ?>
    
    <div class="container">
      <div class="row">
        <div class="col">
           <div class="jumbotron">
                <h1 class="display-4">GeoEstados</h1>
                <div id="container"></div>
                <?php /*
                if (count($estados_list)>0){
                    echo 'existem: '.count($estados_list)." itens";
                }else{
                  echo'não tem coisa';
                }
                ?>
                <hr>
                <?php
                if (count($estados_list)>0){
                  foreach($estados_list as $estado){
                    echo '<p>
                    '.$estado['sigla'].' - '.$estado['nome'].'
                    </p>';
                  }
                }else{
                  echo'não tem coisa';
                }
                */?>
            
            </div>
        </div>  
      </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
      Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Dados atualizados dos municípios por estados 2023',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
          <?php

foreach($total_estados as $estado){

  echo"
  {
    name: '".$estado['name']."',
    y: ".$estado['y']."
  },
  ";
}


          ?>
        ]
    }]
});
    </script>
      
  </body>
</html>