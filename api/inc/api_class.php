<?php 
class api_class {
    private array $data;
    private array $available_methods; 

    public function __construct() 
    {
        $this->data = [];
        $this->available_methods = ['GET', 'POST'];
    }

    // Verifica se o método é valido.
    public function check_method(string $method):bool 
    {
        
        return in_array($method, $this->available_methods);
    }

    public function set_method(string $method):void {
        $this->data['method'] = $method;
    }

    public function api_request_error ($message = '') {
        $this->data['status'] = 'ERROR';
        $this->data['error_message'] = $message;
        $this->send_response();
    }

    public function send_api_status () {
        $this->data['status'] = 'SUCCESS';
        $this->data['message'] = 'API funcionando!!!';
        $this->send_response();
    }

    public function send_response() {
        header('Content-Type:application/json');
        echo json_encode($this->data);
        die();
    }
}