<?php

class api_logic {
    private string $endpoint;
    private ?array $params;

    public function __construct (string $endpoint, ?array $params = NULL) {
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

    public function error_response ($message) {
        return [
            'status'   => 'ERROR',
            'message'  => $message,
            'results'  => []
        ];
    }

    public function get_all_clients () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM clientes");

        return [
            'status'   => 'SUCCESS',
            'message'  => '',
            'results'  => $results
        ];
    }

    public function get_all_active_clients () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM clientes WHERE deleted_at IS NULL");

        return [
            'status'   => 'SUCCESS',
            'message'  => '',
            'results'  => $results
        ];
    }

    public function get_all_unactive_clients () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM clientes WHERE deleted_at IS NOT NULL");

        return [
            'status'   => 'SUCCESS',
            'message'  => '',
            'results'  => $results
        ];
    }

    public function get_client () {
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if (key_exists('id', $this->params) && filter_var($this->params['id'], FILTER_VALIDATE_INT))
            $sql .= " AND id_cliente = ". intval($this->params['id']);
        else
            return $this->error_response('ID client not specified.');

        $db = new database;
        $results = $db->EXE_QUERY($sql);

        return [
            'status'   => 'SUCCESS',
            'message'  => '',
            'results'  => $results
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