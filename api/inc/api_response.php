<?php 
class api_response {
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

    public function get_method():string {
        return $this->data['method'];
    }

    public function set_endpoint(string $endpoint):void {
        $this->data['endpoint'] = $endpoint;
    }

    public function get_endpoint():string {
        return $this->data['endpoint'];
    }

    public function add_do_data($key, $value) {
        $this->data[$key] = $value;
    }

    public function api_request_error ($message = '') {        
        $this->data['data'] = [
            'status'  => 'ERROR',
            'message' => $message,
            'results' => NULL
        ];

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