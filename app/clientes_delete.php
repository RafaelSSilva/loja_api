<?php
    // http://localhost/loja_api/app/clientes_delete.php?id=1
    // http://127.0.0.1/loja_api/app/clientes_delete.php?id=1
        
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $cliente = [];
    $error_message = '';

    // Verifica se foi indicado um id (id_cliente)    
    if (!isset($_GET['id'])) {
        header('Location: clientes.php');
        exit;
    }

    $id_cliente = $_GET['id'];

    // Verifica se é para eleminar o cliente.
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        $result = api_request('delete_client', 'POST', ['id' => $_GET['id']]);
        if (!isset($_GET['id'])) {
            header('Location: clientes.php');
            exit;
        }
    }

    //Busca os dados do cliente à API
    $result = api_request('get_client', 'GET', ['id' => $_GET['id']]);

    if ($result['data']['status'] === 'SUCCESS') {
        if (count($result['data']['results']) == 0) {
            header('Location: clientes.php');
            exit;
        }
        
        $cliente = $result['data']['results'][0];     
    } else {
        $error_message = $result['data']['message'];
    }
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

    <section class="container">
        <div class="row my-5">
            <div class="col col-sm-6 offset-sm-3">
                    <?php if (count($cliente) > 0) : ?>
                        <div class="text-center">
                            <h3>Deseja remover o cliente <?=$cliente['nome']?> ?</h3>

                            <div class="mt-5">
                                <a href="clientes.php" class="btn btn-secondary btn-sm">Não</a>
                                <a href="clientes_delete.php?id=<?=$cliente['id_cliente']?>&confirm=true" class="btn btn-primary btn-sm">Sim</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?=$error_message;?>
                        </div>

                        <div class="text-center ">
                            <a href="clientes.php" class="btn btn-secondary btn-sm">Voltar</a>
                        </div>
                    <?php endif; ?>    
            </div>
        </div>
    </section>

    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
  
  