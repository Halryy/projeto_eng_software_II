<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemade Gestão de Prestadores de serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style type="text/css">
        h3 {
          text-align: center;
        }
	  </style>
</head>
<body>
<div class="container">    
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <h1>SisGerPrestServ v1.0</h1>
      <?php if ($usuario === false) { ?>
      <div class="col-md-3 text-end">
        <a class="btn btn-outline-primary me-2" href="index.php?modulo=autenticacao&acao=login">Login</a>
      </div>
      <?php } else { ?>
        <p>
          Usuário: <?=$usuario['nome']?>
          <a class="btn btn-secondary" href='index.php?modulo=autenticacao&acao=logout'>logout</a>
        </p>
      <?php } ?>
    </header>    
<?php 
    $mensagem = lerMensagem();
    if ($mensagem !== false) {
?>
    <div class="alert alert-<?=$mensagem['tipo']?> alert-dismissible fade show" role="alert">
        <?=$mensagem['mensagem']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    }
?>
    