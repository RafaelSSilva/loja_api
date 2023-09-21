<?php
    /**
     * http://localhost/loja_api/app/
     * http://localhost/loja_api/app/index.php
     */
             
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
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
    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
<?php  
  /*
    $variables = [
        'nome'      => 'Rafael',
        'apelido'   => 'Rafa',
        'sobrenome' => 'Santos Da Silva',
        'idade'     => 31
    ];
    

    print '<h3>Status da API:</h3>';
    $result = api_request('status', 'GET');
    print '<pre>'; print_r ($result); print '</pre>';
    print '<hr>';

    

    print '<h3>Clientes Ativos: </h3>';
    $result = api_request('get_all_active_clients', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $client) {
                print "Nome: {$client['nome']} <br>";
                print "E-mail: {$client['email']} <br>";
                print "Telefone: {$client['telefone']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum cliente ativo foi encontrado.';            
        }
        
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';

    print '<h3>Clientes Inativos: </h3>';
    $result = api_request('get_all_unactive_clients', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0)
            foreach($result['data']['results'] as $client) {
                print "Nome: {$client['nome']} <br>";
                print "E-mail: {$client['email']} <br>";
                print "Telefone: {$client['telefone']} <br>";
                print '<br>';
            }
        else {
            print 'Nenhum cliente inativo foi encontrado.';
        }    
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';

    print '<h3>Cliente: </h3>';
    $result = api_request('get_client', 'GET', ['id' => 1]);
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $client) {
                print "Nome: {$client['nome']} <br>";
                print "E-mail: {$client['email']} <br>";
                print "Telefone: {$client['telefone']} <br>";
                print '<br>';
            }
        } else {
            print 'Cliente não encontrado.';
        }
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';
    
    print '<h3>Produtos: </h3>';
    $result = api_request('get_all_products', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $product) {
                print "Nome: {$product['nome']} <br>";
                print "Quantidade: {$product['quantidade']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum produtos foi encontrado.';
        }
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';

    print '<h3>Produtos Ativos: </h3>';
    $result = api_request('get_all_active_products', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $product) {
                print "Nome: {$product['nome']} <br>";
                print "Quantidade: {$product['quantidade']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum produto ativo foi encontrado.';
        }
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';

    print '<h3>Produtos Inativos: </h3>';
    $result = api_request('get_all_unactive_products', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $product) {
                print "Nome: {$product['nome']} <br>";
                print "Quantidade: {$product['quantidade']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum produto inativo foi encontrado.';
        }
    } else {
        print "ERROR: {$result['data']['message']}";
    }    
    print '<hr>';

    print '<h3>Produtos sem estoque: </h3>';
    $result = api_request('get_all_products_without_stock', 'GET');
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $product) {
                print "Nome: {$product['nome']} <br>";
                print "Quantidade: {$product['quantidade']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum produto sem estoque foi encontrado.';
        } 
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';
    
    print '<h3>Produto: </h3>';
    $result = api_request('get_product', 'GET', ['id' => 1]);
    if ($result['data']['status'] === 'SUCCESS') {
        if (is_array($result['data']['results']) && count($result['data']['results']) > 0) {
            foreach($result['data']['results'] as $product) {
                print "Nome: {$product['nome']} <br>";
                print "Quantidade: {$product['quantidade']} <br>";
                print '<br>';
            }
        } else {
            print 'Nenhum produto foi encontrado.';
        } 
    } else {
        print "ERROR: {$result['data']['message']}";
    }
    print '<hr>';
    */