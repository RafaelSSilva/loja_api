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

    
    $result = api_request('status', 'POST', $variables);

    echo '<pre>';
    print_r ($result);
    echo '</pre>';
    
    
    