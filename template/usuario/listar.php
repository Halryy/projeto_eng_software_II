<?php
    include __DIR__.'/../cabecalho.php';
?>    
<h3>Listagem de Usuários do sistema</h3>

<table class='table table-striped'>
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>login</th>
            <th>tipo</th>
            <th style="width: 200px;">ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($usuarios as $id => $usuario) { ?>
            <tr>
                <td><?=$id?></td>
                <td><?=$usuario['nome']?></td>
                <td><?=$usuario['login']?></td>
                <td><?=$usuario['tipo']?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a class='btn btn-primary' href='index.php?modulo=usuario&acao=editar&id=<?=$id?>'>Editar</a>
                        <a class='btn btn-danger' href='index.php?modulo=usuario&acao=excluir&id=<?=$id?>'>Excluir</a>
                    </div>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
<a class='btn btn-primary' href="index.php?modulo=usuario&acao=novo">Adicionar novo usuario</a>
<a class='btn btn-default' href="index.php?modulo=prestador-servico&acao=listar">Listagem de prestadores de serviço</a>


<?php
    include __DIR__.'/../rodape.php';
?>    