<?php
//http://localhost/loja_api/api/index.php

require_once dirname(__FILE__).'/inc/config.php';
require_once dirname(__FILE__).'/inc/api_class.php';

$api = new api_class;


if (!$api->check_method($_SERVER['REQUEST_METHOD'])) {
    $api->api_request_error('Aconteceu um erro na API!!!');
    
}

$api->send_api_status();


//var_dump(__FILE__);
//var_dump(dirname(__FILE__));

  
//resposta temporária
//header('Content-Type:application/json');

//$data['status'] = 'SUCCESS';
//$data['method'] = $_SERVER['REQUEST_METHOD'];

//if ($data['method'] == 'GET') {
  //  $data['data'] = $_GET;
//} else if ($data['method'] == 'POST') {
  //  $data['data'] = $_POST;
//}

//apresenta as variáveis que vieram no pedido (get ou post)
//echo json_encode($data);

   