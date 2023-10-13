<?php
    /**
     * http://localhost/loja_api/app/cliente_edit.php?id=
     * http://127.0.0.1/loja_api/app/cliente_edit.php?id=
     */
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $error_message = $success_message = '';
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            header('Location: clientes.php');
        }

        $cliente_id = $_GET['id']; 

        $result = api_request('get_client', 'GET', ['id' => $cliente_id]);
        if (count($result['data']['results']) <= 0) {
            header('Location: clientes.php');
        }

        $cliente['nome']     = $result['data']['results'][0]['nome'];
        $cliente['email']    = $result['data']['results'][0]['email'];
        $cliente['telefone'] = $result['data']['results'][0]['telefone'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cliente_id = $_POST['cliente_id']; 

        $cliente['nome']     = isset($_POST['text_nome']) ? $_POST['text_nome'] : '';
        $cliente['email']    = isset($_POST['text_email']) ? $_POST['text_email'] : '';
        $cliente['telefone'] = isset($_POST['text_telefone']) ? $_POST['text_telefone'] : '';
    
        $result = api_request('update_client', 'POST', ['id' => $cliente_id, 'nome' => $cliente['nome'], 'email' => $cliente['email'], 'telefone' => $cliente['telefone']]);
        if ($result['data']['status'] == 'SUCCESS') 
            $success_message = $result['data']['message'];
        elseif ($result['data']['status'] == 'ERROR') 
            $error_message = $result['data']['message'];
    
    }


?>    

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Consumidora - Novo Cliente</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
</head>
<body>
    <?php include 'inc/nav.php';?>
    
    <section class="container">
        <div class="row my-5">
            <div class="col-sm-6 card offset-sm-3 p-2">
                <form action="cliente_edit.php" method="POST">
                    <input type="hidden" name="cliente_id" value="<?=$cliente_id?>">
                
                    <div class="mb-3">
                        <label>Nome do Cliente:</label>
                        <input id="text_nome" name="text_nome" type="text" class="form-control" value="<?=$cliente['nome']?>">
                    </div>

                    <div class="mb-3">
                        <label>Telefone:</label>
                        <input id="text_telefone" name="text_telefone" type="text" class="form-control" value="<?=$cliente['telefone']?>">
                    </div>

                    <div class="mb-3">
                        <label>E-mail:</label>
                        <input id="text_email" name="text_email" type="email" class="form-control" value="<?=$cliente['email']?>">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="clientes.php" class="btn btn-secondary btn-sm">Cancelar</a>
                        <input id="btn_add" name="btn_add" type="submit" value="Editar" class="btn btn-primary btn-sm">
                    </div>
                        
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success p-2 text-center">
                            <?=$success_message;?>
                        </div>
                    <?php elseif (!empty($error_message)): ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?=$error_message;?>
                        </div>
                    <?php endif; ?>  
                </form>
            </div>    
        </div>
    </section>

    <script src="assets/bootstrap/bootstrap.min.js"></script>
</body>
</html>

  
  
  