<?php
/**
 * http://localhost/loja_api/api/index.php
 * http://localhost/loja_api/api/index.php?endpoint=status
 */


require_once dirname(__FILE__).'/inc/config.php';
require_once dirname(__FILE__).'/inc/api_response.php';
require_once dirname(__FILE__).'/inc/api_logic.php';
require_once dirname(__FILE__).'/inc/database.php';

$api_response = new api_response;

if (!$api_response->check_method($_SERVER['REQUEST_METHOD'])) {
    $api_response->api_request_error('Invalid request method.');
}

$api_response->set_method($_SERVER['REQUEST_METHOD']);
$params = NULL;
if ($api_response->get_method() == 'GET') {
    $api_response->set_endpoint(isset($_GET['endpoint']) ? $_GET['endpoint'] : '');
    $params = $_GET;
} elseif ($api_response->get_method() == 'POST') {
    $api_response->set_endpoint(isset($_POST['endpoint']) ? $_POST['endpoint'] : '');
    $params = $_POST;
}


//Rotas
$api_logic = new api_logic($api_response->get_endpoint(), $params);

if (!$api_logic->endpoint_exists()) {
    $api_response->api_request_error('Inexistent endpoint: ' . $api_response->get_endpoint());
}


$result = $api_logic->{$api_response->get_endpoint()}();
$api_response->add_do_data('data', $result);
$api_response->send_response();









   