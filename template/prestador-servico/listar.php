<?php
    include __DIR__.'/../cabecalho.php';
?>    
<h3>Listagem de Prestadores de serviço</h3>

<table class='table table-striped'>
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nome completo</th>
            <th>email</th>
            <th>Período</th>
            <th>Região</th>
            <th>Atividades</th>
            <th>ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($prestadores as $id => $prestador) { ?>
            <tr>
                <td><img class="img-thumbnail" style="width: 100px;" src='index.php?acao=imagem&modulo=prestador-servico&id=<?=$id?>'></td>
                <td><?=$prestador['nome']." ".$prestador['sobrenome']?></td>
                <td><?=$prestador['email']?></td>
                <td><?=$prestador['dataInicial']?> até <?=$prestador['dataFinal']?></td>
                <td><?=$prestador['regiao']?></td>
                <td><?=implode(', ',$prestador['atividades'])?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a class='btn btn-primary' href='index.php?acao=editar&id=<?=$id?>'>Editar</a>
                        <a class='btn btn-danger' href='index.php?acao=excluir&id=<?=$id?>'>Excluir</a>
                    </div>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
<a class='btn btn-primary' href="index.php?modulo=prestador-servico&acao=novo">Adicionar novo prestador de serviço</a>
<a class='btn btn-default' href="index.php?modulo=usuario&acao=listar">Listar usuários</a>

<?php
    include __DIR__.'/../rodape.php';
?>    