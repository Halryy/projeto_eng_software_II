<?php
include __DIR__.'/../cabecalho.php';
?>    
        <h3>Formulário de cadastro de usuário do sistema</h3>
		<form name="formulario" action="" method="post" enctype="multipart/form-data">
            <input  type='hidden' name='acao' value='inserir'>
            <input  type='hidden' name='modulo' value='usuario'>
			<div class="mb-3">
                <label class='form-label' for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" id="nome" />
            </div>
            <div class="mb-3">
                <label class='form-label'  for="login">login</label>
                <input  class="form-control" type="text" name="login" id="login" />
            </div>
			<div class="mb-3">
                <label class='form-label'  for="senha">senha</label>
                <input  class="form-control" type="password" name="senha" id="senha" />
            </div>
    		<div class="form-check">
                <input  class="form-check-input" type="radio" name="tipo" id="administrador" value="administrador" />
                <label class='form-label'  for="administrador">Administrador</label>
                </div>
			<div class="form-check">
                <input  class="form-check-input" type="radio" name="tipo" id="super" value="super-administrador" />
                <label class='form-label'  for="super">Super-administrador</label>
                </div>
			<div>
                <button class='btn btn-primary' type='submit'>Enviar</button>
                <button class='btn btn-default' type='reset'>Reiniciar</button>
			</div>
		</form>
<?php
include __DIR__.'/../rodape.php';
?>            