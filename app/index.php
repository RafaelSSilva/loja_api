<?php
    //http://localhost/loja_api/app/     
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';

    $variables = [
        'nome'      => 'Rafael',
        'apelido'   => 'Rafa',
        'sobrenome' => 'Santos Da Silva',
        'idade'     => 31
    ];

    /*
    $result = api_request('status', 'GET', $variables);
    echo '<pre>'; print_r ($result); echo '</pre>';

    $result = api_request('statusx', 'GET', $variables);
    echo '<pre>'; print_r ($result); echo '</pre>';

    $result = api_request('get_all_clients', 'GET', $variables);
    echo '<pre>'; print_r ($result); echo '</pre>';

    $result = api_request('get_all_products', 'GET', $variables);
    echo '<pre>'; print_r ($result); echo '</pre>';
    */

    
    print '<h3>Clientes: </h3>';
    $result = api_request('get_all_clients', 'GET', $variables);
    foreach($result['data']['results'] as $client) {
        print "Nome: {$client['nome']} <br>";
        print "E-mail: {$client['email']} <br>";
        print "Telefone: {$client['telefone']} <br>";
        print '<br>';
    } 
    print '<hr>';
   
    print '<h3>Produtos: </h3>';
    $result = api_request('get_all_products', 'GET', $variables);
    foreach($result['data']['results'] as $product) {
        print "Nome: {$product['nome']} <br>";
        print "Quantidade: {$product['quantidade']} <br>";
        print '<br>';
    } 
    
   
    
    