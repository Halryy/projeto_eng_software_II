<?php
include __DIR__.'/../cabecalho.php';
?>    
<h3>Autenticar</h3>

<form action="index.php" method="post">
    <input type="hidden" name="acao" value="login">
    <input type="hidden" name="modulo" value="autenticacao">
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Usuário</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="staticEmail" name='login'>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" name="senha">
    </div>
  </div>
    <button type="submit" class="btn btn-primary">Autenticar</button>
  </form>
<?php
include __DIR__.'/../rodape.php';
?>    