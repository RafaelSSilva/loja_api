<?php
    /**
     * http://localhost/loja_api/app/produtos.php
     * http://127.0.0.1/loja_api/app/produtos.php
     */
        
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $produtos = [];
    
    $result = api_request('get_all_active_products', 'GET');
    if ($result['data']['status'] === 'SUCCESS') 
        $produtos = (array) $result['data']['results'];     
    else 
        die("ERROR: {$result['data']['message']}");

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
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h1>Produtos</h1>
                    </div>
                            
                    <div class="col text-end align-self-center">
                        <a href="produto_novo.php" class="btn btn-primary btn-sm">Adicionar Produto...</a>
                    </div>
                </div>  
            <hr>                
        <?php
        if (count($produtos) == 0): ?>
            <p class="text-center">Não existem produtos registrados.</p>
        <?php else : ?> 
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                              
                <tbody>
                    <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td><?=$produto['nome']?></td>
                        <td><?=$produto['quantidade']?></td>
                        <td>
                            <a href="produto_edit.php?id=<?=$produto['id_produto']?>">&#9998;</a>
                            <a href="produtos_delete.php?id=<?=$produto['id_produto']?>">&#128465;</a>
                        </td>
                    </tr>                                  
                    <?php endforeach;?>
                </tbody>
            </table>
            <p class="text-end"><strong>Total: <?=count($produtos)?></strong></p>
        <?php endif; ?>                        
        </div>
    </div>                 
    </section>  
    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

