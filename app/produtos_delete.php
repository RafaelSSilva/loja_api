<?php
    // http://localhost/loja_api/app/produtos_delete.php?id=1
    // http://127.0.0.1/loja_api/app/produtos_delete.php?id=1
        
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $produto = [];
    $error_message = '';

    
    // Verifica se foi indicado um id (id_produto)    
    if (!isset($_GET['id'])) {
        header('Location: produtos.php');
        exit;
    }
    
    $id_produto = $_GET['id'];
    
    // Verifica se é para eleminar o produto.
    if (isset($_GET['confirm']) AND $_GET['confirm'] == 'true') {
        api_request('delete_product', 'POST', ['id' => $_GET['id']]);
        header('Location: produtos.php');
        exit;        
    }

    //Busca os dados do produto à API
    $result = api_request('get_product', 'GET', ['id' => $_GET['id']]);

    if ($result['data']['status'] === 'SUCCESS') {
        if (count($result['data']['results']) == 0) {
            header('Location: produtos.php');
            exit;
        }
        
        $produto = $result['data']['results'][0];     
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
                    <?php if (count($produto) > 0) :?>
                        <div class="text-center">
                            <h3>Deseja remover o produto <?=$produto['nome']?> ?</h3>

                            <div class="mt-5">
                                <a href="produtos.php" class="btn btn-secondary btn-sm">Não</a>
                                <a href="produtos_delete.php?id=<?=$produto['id_produto'];?>&confirm=true" class="btn btn-primary btn-sm">Sim</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?=$error_message;?>
                        </div>

                        <div class="text-center ">
                            <a href="produtos.php" class="btn btn-secondary btn-sm">Voltar</a>
                        </div>
                    <?php endif; ?>    
            </div>
        </div>
    </section>

    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
  
  