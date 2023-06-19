<?php
//http://localhost/loja_api/api/index.php

  
//resposta temporária
header('Content-Type:application/json');

$data['status'] = 'SUCCESS';
$data['method'] = $_SERVER['REQUEST_METHOD'];

if ($data['method'] == 'GET') {
    $data['data'] = $_GET;
} else if ($data['method'] == 'POST') {
    $data['data'] = $_POST;
}

//apresenta as variáveis que vieram no pedido (get ou post)
echo json_encode($data);

   