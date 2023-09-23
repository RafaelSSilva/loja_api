<?php
    /**
     * http://localhost/loja_api/app/cliente_novo.php
     * http://127.0.0.1/loja_api/app/cliente_novo.php
     */
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

    $error_message = $success_message = '';

    //Lógica e regras de negócios.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'nome'     => $_POST['text_nome'], 
            'email'    => $_POST['text_email'], 
            'telefone' => $_POST['text_telefone']
        ];
                
        $result = api_request('create_new_client', $_SERVER['REQUEST_METHOD'], $data);

        //print '<pre>'; print_r($result); print '</pre>';

        // Apresenta o resultado na operação na API.
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
                <form action="cliente_novo.php" method="POST">
                    <div class="mb-3">
                        <label>Nome do Cliente:</label>
                        <input id="text_nome" name="text_nome" type="text" class="form-control" value="">
                    </div>

                    <div class="mb-3">
                        <label>Telefone:</label>
                        <input id="text_telefone" name="text_telefone" type="text" class="form-control" value="">
                    </div>

                    <div class="mb-3">
                        <label>E-mail:</label>
                        <input id="text_email" name="text_email" type="email" class="form-control" value="">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="clientes.php" class="btn btn-secondary btn-sm">Cancelar</a>
                        <input id="btn_add" name="btn_add" type="submit" value="Salvar" class="btn btn-primary btn-sm">
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

  
  
  