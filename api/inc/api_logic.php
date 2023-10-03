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

    // ------------------------------------------------------------------------------------------------------------------
    // CLIENTES
    // ------------------------------------------------------------------------------------------------------------------

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

    public function create_new_client() {
        if (isset($this->params['nome'], $this->params['email'], $this->params['telefone']) === false) {
            return $this->error_response('Insufficient client data.');
        }
        
        if (empty($this->params['nome']) || strlen(trim($this->params['nome'])) === 0) {
            return $this->error_response('Invalid name.');
        }

        if (empty($this->params['email']) || strlen(trim($this->params['email'])) === 0) {
            return $this->error_response('Invalid email.');
        }

        if (empty($this->params['telefone']) || strlen(trim($this->params['telefone'])) === 0) {
            return $this->error_response('Invalid phone.');
        }


        $db = new database;

        $params = [ 'email' => $this->params['email']];
        $results = $db->EXE_QUERY("
            SELECT id_cliente FROM clientes 
            WHERE 1 
            AND email = :email
            AND deleted_at IS NULL
        ", $params);

        if (count($results) != 0) {
            return $this->error_response('There is already another client with the same email.');            
        }
        

        $params = [
            ':nome'     => $this->params['nome'],
            ':email'    => $this->params['email'],
            ':telefone' => $this->params['telefone']
        ];

        
        $db->EXE_NON_QUERY("
                INSERT INTO clientes VALUES (
                        0, 
                        :nome, 
                        :email, 
                        :telefone, 
                        NOW(), 
                        NOW(),
                        NULL
                    )
                ", $params);

        
        return [
            'status'   => 'SUCCESS',
            'message'  => 'New client add with success ',
            'results'  => []
        ];
    }

    public function delete_client () {
        if (!key_exists('id', $this->params) || filter_var($this->params['id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) === false)
            return $this->error_response('ID client not specified.');
            
        $db = new database;
        
        $params = ['id' => $this->params['id']];

        
        //Hard delete
        //$db->EXE_NON_QUERY("DELETE FROM clientes WHERE id_cliente = :id", $params);

        //Soft delete
        $db->EXE_NON_QUERY("UPDATE clientes SET deleted_at = NOW() WHERE id_cliente = :id", $params);

        return [
            'status'   => 'SUCCESS',
            'message'  => 'Client deleted with success ',
            'results'  => []
        ];
    }



    
    // ------------------------------------------------------------------------------------------------------------------
    // PRODUTOS
    // ------------------------------------------------------------------------------------------------------------------

    public function get_all_products() {
        $db = new database;
        $results = $db->EXE_QUERY('SELECT * FROM produtos');
        
        return [
            'status'  => 'SUCCESS',
            'message' => '',
            'results' => $results
        ];
    }

    public function get_all_active_products () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM produtos WHERE deleted_at IS NULL");
      
        return [
          'status'   => 'SUCCESS',
          'message'  => '',
          'results'  => $results
        ];
      }
      
      public function get_all_unactive_products () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM produtos WHERE deleted_at IS NOT NULL");
      
        return [
          'status'   => 'SUCCESS',
          'message'  => '',
          'results'  => $results
        ];
      }
      
      public function get_all_products_without_stock () {
        $db = new database;
        $results = $db->EXE_QUERY("SELECT * FROM produtos WHERE quantidade <= 0 AND deleted_at IS NULL");
      
        return [
          'status'   => 'SUCCESS',
          'message'  => '',
          'results'  => $results
        ];
      }
      
      public function get_product () {
        $sql = "SELECT * FROM produtos WHERE 1 ";
      
        if (key_exists('id', $this->params) && filter_var($this->params['id'], FILTER_VALIDATE_INT))
          $sql .= " AND id_produto = ". intval($this->params['id']);
        else
         return $this->error_response('ID product not specified.');
      
        $db = new database;
        $results = $db->EXE_QUERY($sql);
      
        return [
          'status'   => 'SUCCESS',
          'message'  => '',
          'results'  => $results
        ];
      }


    public function create_new_product() {
        if (!isset($this->params['nome'], $this->params['qtd'])) {
            return $this->error_response('Insufficient product data.');
        }
        
        if (empty($this->params['nome']) || strlen(trim($this->params['nome'])) === 0) {
            return $this->error_response('Invalid name.');
        }

        if (filter_var($this->params['qtd'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0))) === false) {
            return $this->error_response('Qty is less than zero.');
        }
        
        $db = new database;

        $params = [
            ':nome' => $this->params['nome'],
            ':qtd'  => $this->params['qtd'],
        ];
        
        $db->EXE_NON_QUERY("
                INSERT INTO produtos VALUES (
                        0, 
                        :nome, 
                        :qtd, 
                        NOW(), 
                        NOW(),
                        NULL
                    )
                ", $params);

        return [
            'status'   => 'SUCCESS',
            'message'  => 'New product add with success ',
            'results'  => []
        ];
        
    }


}