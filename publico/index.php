<?php
    session_start();
    require_once '../util/biblioteca.php';

    $acao   = $_REQUEST['acao'] ?? 'listar';
    $modulo = $_REQUEST['modulo'] ?? 'prestador-servico';

    $usuario = obterUsuarioAutenticado();

    switch ($modulo) {
        case 'prestador-servico':
            require_once '../controlador/prestador-servico.php';
            break;
        case 'usuario':
            require_once '../controlador/usuario.php';
            break;
        case 'autenticacao':
            require_once '../controlador/autenticacao.php';
            break;
    }
    
