<?php
switch($acao) {
        case 'logout': 
            sair();
            inserirMensagem("logout efetuado com sucesso... bye bye!", 'success');
            header('location: index.php?acao=listar');    
        break;  
        case 'login': 
            if ($_POST) {
                $login = $_POST['login'] ??'';
                $senha = $_POST['senha'] ??'';

                if (autenticar($login,$senha)) {
                    $usuario = obterUsuarioAutenticado();
                    header('location: index.php?acao=listar');    
                } else {
                    inserirMensagem("falha ao autenticar usuário","warning");
                    include '../template/autenticacao/login.php';    
                }

            } else {
                include '../template/autenticacao/login.php';
            }
        break;
}