<?php

switch($acao) {
    case 'editar':
        if ($usuario === false) {
            inserirMensagem('somente para usuários autenticados','warning');
            header('location: index.php?acao=listar');
            return;    
        }
        if ($_POST) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $tipo = $_POST['tipo'];
            $senha = $_POST['senha'] ?? false;
            editarUsuario($id,
                        $nome, 
                        $login,
                        $tipo,
                        $senha
                );
            inserirMensagem("Usuario $nome foi alterado com sucesso em nossas base de dados!", "success");
            header('location: index.php?modulo=usuario&acao=listar');
        } else {
            $id = $_GET['id'];
            $usuario = lerUsuario($id);
            if ($usuario === false) {
                inserirMensagem("Usuário não encontrador", "warning");
                header('location: index.php?modulo=usuario&acao=listar');                
            } else {
                include '../template/usuario/editar.php';
            }
        }
    break;
    case 'excluir': 
        $id = $_GET['id'];
        $resultado = excluirUsuario($id);
        if ($resultado) {
            inserirMensagem("Prestador de serviços excluído com sucesso", "success");
        } else {
            inserirMensagem("Não foi possível excluir o prestador selecionado", "warning");
        }
        header('location: index.php?modulo=usuario&acao=listar');
    break;
    case 'listar':
        if ($usuario === false) {
            inserirMensagem('somente para usuários autenticados','warning');
            header('location: index.php?acao=listar');
            return;    
        }
        $usuarios = lerUsuarios();
        include '../template/usuario/listar.php';
    break;
    case 'novo':
        if ($usuario === false) {
            inserirMensagem('somente para usuários autenticados','warning');
            header('location: index.php?modulo=usuario&acao=listar');
            return;    
        }
        include '../template/usuario/adicionar.php';
    break;
    case 'inserir':
        if ($usuario === false) {
            inserirMensagem('somente para usuários autenticados','warning');
            header('location: index.php?modulo=usuario&acao=listar');
            return;    
        }
        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $tipo = $_POST['tipo'];
        $senha = $_POST['senha'];
        adicionarUsuario($nome, 
                    $login,
                    $tipo,
                    $senha
            );
        inserirMensagem("Usuario $nome foi inserido com sucesso em nossas base de dados!", "success");
        header('location: index.php?modulo=usuario&acao=listar');

    break;    
    }