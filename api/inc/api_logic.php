<?php

class api_logic {
    private string $endpoint;
    private ?array $params;

    public function __construct ($endpoint, $params = NULL) {
        $this->endpoint = $endpoint;
        $this->params   = $params;
    }

    public function endpoint_exists():bool {
        return method_exists($this, $this->endpoint);
    }

    /***** ENDPOINTS********************************************************************************************************************************************** */

    public function status() {
        return [
            'status'  => 'SUCCESS',
            'message' => 'API is running ok',
            'results' => NULL
        ];
        
    }

    public function get_all_clients() {
        $db = new database;
        $results = $db->EXE_QUERY('SELECT * FROM clientes');
        
        return [
            'status'  => 'SUCCESS',
            'message' => '',
            'results' => $results
        ];
        
    }

    public function get_all_products() {
        $db = new database;
        $results = $db->EXE_QUERY('SELECT * FROM produtos');
        
        return [
            'status'  => 'SUCCESS',
            'message' => '',
            'results' => $results
        ];
    }

}