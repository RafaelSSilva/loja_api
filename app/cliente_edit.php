<?php
    /**
     * http://localhost/loja_api/app/cliente_edit.php?id=
     * http://127.0.0.1/loja_api/app/cliente_edit.php?id=
     */
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $error_message = $success_message = '';
    
    if (!isset($_GET['id'])) {
        header('Location: clientes.php');
        exit;
    }

    $cliente['id'] = $_GET['id'];
    $endpoint = 'get_client';
    $method   = 'GET';

    if (isset($_GET['edit'])) {
        $endpoint = 'edit_client';
        $method   = 'POST';
        $cliente['nome']     = isset($_POST['text_nome']) ? $_POST['text_nome'] : '';
        $cliente['email']    = isset($_POST['text_email']) ? $_POST['text_email'] : '';
        $cliente['telefone'] = isset($_POST['text_telefone']) ? $_POST['text_telefone'] : '';     
    } 
    
    $result = api_request($endpoint, $method, $cliente);


    if (isset($_GET['edit']) AND $result['data']['status'] == 'SUCCESS') {
        header('Location: clientes.php');
        exit;
    }
   
    if (isset($_GET['edit']) AND $result['data']['status'] == 'ERROR') {
        $error_message = $result['data']['message'];
    }

    if (!isset($_GET['edit']) AND $result['data']['status'] == 'SUCCESS') {
        $cliente['nome']     = $result['data']['results'][0]['nome'];
        $cliente['email']    = $result['data']['results'][0]['email'];
        $cliente['telefone'] = $result['data']['results'][0]['telefone'];
    }

    if (!isset($_GET['edit']) AND $result['data']['status'] == 'ERROR') {
        header('Location: clientes.php');
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
                <form action="cliente_edit.php?id=<?=$cliente['id'];?>&edit=true" method="POST">
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
                        
        
                    <?php if (!empty($error_message)): ?>
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

  
  
  