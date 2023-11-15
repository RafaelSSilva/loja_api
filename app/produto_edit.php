<?php
    /**
     * http://localhost/loja_api/app/pruduto_edit.php
     * http://127.0.0.1/loja_api/app/produto_edit.php
     */
         
    require_once 'inc/config.php';
    require_once 'inc/api_functions.php';
    require_once 'inc/functions.php';

     $error_message = $success_message = '';

     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            header('Location: produtos.php');
            exit;
        }

        $produto_id = $_GET['id']; 

        $result = api_request('get_product', 'GET', ['id' => $produto_id]);
        if (count($result['data']['results']) <= 0) {
            header('Location: produtos.php');
            exit;
        }

        
        $produto['nome']       = $result['data']['results'][0]['nome'];
        $produto['quantidade'] = $result['data']['results'][0]['quantidade'];   
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $produto_id = $_POST['produto_id']; 

        $produto['nome']       = isset($_POST['text_nome']) ? $_POST['text_nome'] : '';
        $produto['quantidade'] = isset($_POST['quantidade']) ? $_POST['quantidade'] : 0;
    
        $result = api_request('update_product', 'POST', ['id_produto' => $produto_id, 'nome' => $produto['nome'], 'quantidade' => $produto['quantidade']]);
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
    <title>App Consumidora - Editar Produto</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
</head>
<body>
    <?php include 'inc/nav.php';?>

    <section class="container">
        <div class="row my-5">
            <div class="col-sm-6 card offset-sm-3 p-2">
                <form action="produto_edit.php" method="POST">
                <input type="hidden" name="produto_id" value="<?=$produto_id?>">

                    <div class="mb-3">
                        <label>Nome do Produto:</label>
                        <input id="text_nome" name="text_nome" type="text" class="form-control" value="<?=$produto['nome']?>">
                    </div>

                    <div class="mb-3">
                        <label>Quantidade:</label>
                        <input id="quantidade" name="quantidade" type="number" class="form-control" value="<?=$produto['quantidade']?>" min="0">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="produtos.php" class="btn btn-secondary btn-sm">Cancelar</a>
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