<?php
    /**
     * http://localhost/loja_api/app/
     * http://localhost/loja_api/app/index.php
     */
             
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';


    $totais = api_request('get_totals', 'GET')['data']['results'];
?>    

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Consumidora</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
</head>
<body>
    <?php include 'inc/nav.php';?>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6 text-center">
                <h3>Clientes: <strong><?=$totais[0]['Total']?></strong></h3>
            </div>
            <div class="col-sm-6 text-center">
                <h3>Produtos: <strong><?=$totais[1]['Total']?></strong></h3>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
