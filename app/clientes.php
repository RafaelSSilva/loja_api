<?php
    // http://localhost/loja_api/app/clientes.php
        
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $clientes = [];
    
    $result = api_request('get_all_active_clients', 'GET');
    if ($result['data']['status'] === 'SUCCESS') 
        $clientes = (array) $result['data']['results'];     
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
                        <h1>Clientes</h1>
                    </div>
                    
                    <div class="col text-end align-self-center">
                        <a href="cliente_novo.php" class="btn btn-primary btn-sm">Adicionar Cliente...</a>
                    </div>
                </div>
                <hr>
                    
                <?php
                    if (count($clientes) == 0): ?>
                        <p class="text-center">Não existem clientes registrados.</p>
                    <?php else : ?> 
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($clientes as $cliente): ?>
                                <tr>
                                    <td><?=$cliente['nome']?></td>
                                    <td><?=$cliente['email']?></td>
                                    <td><?=$cliente['telefone']?></td>
                                    <td><a href="clientes_delete.php?id=<?=$cliente['id_cliente']?>">Deletar</a></td>
                                </tr>
                                
                                <?php endforeach;?>
                                
                            </tbody>
                        </table>
                        <p class="text-end"><strong>Total: <?=count($clientes)?></strong></p>
                    <?php endif; ?>                        
            </div>
        </div>
    </section>

    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
  
  