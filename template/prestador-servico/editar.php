<?php
include __DIR__.'/../cabecalho.php';
?>    
        <h3>Formulário de cadastro de prestador de serviços</h3>
		<form name="formulario" action="" method="post" enctype="multipart/form-data">
			<input type='hidden' name='acao' value='editar'>
            <input type='hidden' name='id' value='<?=$id?>'>
			<div class="mb-3">
                <label class='form-label' for="foto">Foto</label>
                <input class="form-control" type="file" name="foto" id="foto" />
            </div>
			<div class="mb-3">
                <label class='form-label' for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" id="nome" value="<?=$prestador['nome']?>" />
            </div>
            <div class="mb-3">
                <label class='form-label'  for="sobrenome">Sobrenome</label>
                <input  class="form-control" type="text" name="sobrenome" id="sobrenome" value="<?=$prestador['sobrenome']?>" />
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label class='form-label'  for="email">E-mail</label>
                        <input  class="form-control" type="email" name="email" id="email"  value="<?=$prestador['email']?>" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label class='form-label'  for="website">Website</label>
                        <input  class="form-control" type="url" name="website" id="website"  value="<?=$prestador['site']?>" />
            		</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label class='form-label'  for="dataini">Data inicial</label>
                        <input  class="form-control" type="date" name="dataini" id="dataini"  value="<?=$prestador['dataInicial']?>" />
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label class='form-label'  for="datafim">Data final</label>
                        <input class="form-control" type="date" name="datafim" id="datafim"  value="<?=$prestador['dataFinal']?>" />
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input  <?=$prestador['regiao'] == 'sul' ? 'checked': ''?>  class="form-check-input" type="radio" name="regiao" id="sul" value="sul" />
                        <label class='form-label'  for="sul">Sul</label>
                    </div>
                </div>
                <div class="col">
        			<div class="form-check">
                        <input <?=$prestador['regiao'] == 'sudeste' ? 'checked': ''?>  class="form-check-input" type="radio" name="regiao" id="sudeste" value="sudeste" />
                        <label class='form-label'  for="sudeste">Sudeste</label>
                    </div>
                    </div>
                <div class="col">
                    <div class="form-check">
                        <input <?=$prestador['regiao'] == 'centro' ? 'checked': ''?>  class="form-check-input" type="radio" name="regiao" id="centro" value="centro-oeste" />
                        <label class='form-label'  for="centro">Centro-oeste</label>
                    </div>
                    </div>
                <div class="col">
                    <div class="form-check">
                        <input <?=$prestador['regiao'] == 'nordeste' ? 'checked': ''?>  class="form-check-input" type="radio" name="regiao" id="nordeste" value="nordeste" />
                        <label class='form-label'  for="nordeste">Nordeste</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input  <?=$prestador['regiao'] == 'norte' ? 'checked': ''?>  class="form-check-input" type="radio" name="regiao" id="norte" value="norte" />
                        <label class='form-label'  for="norte">Norte</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-check form-switch">
                        <input <?=in_array('analista',$prestador['atividades']) ? 'checked' : ''?>  class="form-check-input" type="checkbox" name="atividade[]" id="analista" value="analista" />
                        <label class='form-label'  for="analista">Analista</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-switch">
                        <input <?=in_array('programador',$prestador['atividades']) ? 'checked' : ''?>  class="form-check-input" type="checkbox" name="atividade[]" id="programador" value="programador" />
                        <label class='form-label'  for="programador">Programador</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-switch">
                        <input <?=in_array('webdesigner',$prestador['atividades']) ? 'checked' : ''?> class="form-check-input" type="checkbox" name="atividade[]" id="webdesigner" value="webdesigner" />
                        <label class='form-label'  for="webdesigner">Web-designer</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-switch">
                        <input <?=in_array('dba',$prestador['atividades']) ? 'checked' : ''?>  class="form-check-input" type="checkbox" name="atividade[]" id="dba" value="dba" />
                        <label class='form-label'  for="dba">DBA</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-switch">
                        <input <?=in_array('administrador',$prestador['atividades']) ? 'checked' : ''?>  class="form-check-input" type="checkbox" name="atividade[]" id="administrador" value="administrador-rede" />
                        <label class='form-label'  for="administrador">Administrador de rede</label>
         			</div>
                </div>
            </div>
            <button class='btn btn-primary' type='submit'>Enviar</button>
            <button class='btn btn-default' type='reset'>Reiniciar</button>
            <a href="index.php?modulo=prestador-servico&acao=listar" class='btn btn-default'>Voltar</a>
		</form>
<?php
include __DIR__.'/../rodape.php';
?>            
