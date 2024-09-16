<?php
switch($acao) {
        case "imagem": 
            $id = $_GET['id'];
            $prestador = lerPrestador($id);
            $imagem = $prestador['foto'];
            $nome = DIR_FOTO.$imagem['src'];
            $mime = $imagem['mime'];
            //MUDAR O HEADER DA RESPOSTA INFORMANDO QUE É UMA IMAGEM
            $fp = fopen($nome, 'rb');
            header("Content-Type: ".$mime);
            header("Content-Length: ".filesize($nome));
            // Manda a imagem e para o script
            fpassthru($fp);
            exit;
        break;
            
        case 'editar':
            if ($usuario === false) {
                inserirMensagem('somente para usuários autenticados','warning');
                header('location: index.php?acao=listar');
                return;    
            }

            if ($_POST) {
                $id = $_GET['id'];
                $nome = $_POST['nome'];
                $sobrenome = $_POST['sobrenome'];
                $email = $_POST['email'];
                $site = $_POST['website'];
                $dataInicial = $_POST['dataini'];
                $dataFinal = $_POST['datafim'];
                $regiao = $_POST['regiao'];
                $atividades = $_POST['atividade'];
    
                $resultado = true;
                $mensagem  = '';
                $arquivo = false;
                if (existeArquivo('foto')) {
                    $arquivo = manipularArquivo('foto');
    
                    if ($arquivo === false) {
                        $mensagem  ="arquivo de foto é inválido";
                        $resultado = false;
                    }                
                }
    
                if ($resultado) {
                    $resultado = editarPrestador($id,
                        $nome, 
                        $sobrenome,
                        $email,
                        $site,
                        $dataInicial,
                        $dataFinal,
                        $regiao,
                        $atividades,
                        $arquivo
                    );
    
                    if ($resultado === false){
                        $mensagem = "Deu errado";
                    } else {
                        $mensagem = "Formulário alterado com sucesso";
                    }
    
                }
                inserirMensagem($mensagem, $resultado ? 'success' : 'danger');
                header('location: index.php?acao=listar');
            } else {
                $id = $_GET['id'];
                $prestador = lerPrestador($id);
                if ($prestador === false) {
                    inserirMensagem("Prestador de serviços não encontrado", "warning");
                    header('location: index.php?acao=listar');                
                } else {
                    include '../template/prestador-servico/editar.php';
                }
            }

        break;

        case 'excluir': 
            if ($usuario === false) {
                inserirMensagem('somente para usuários autenticados','warning');
                header('location: index.php?acao=listar');
                return;    
            }
            if ($usuario['tipo'] != 'super-administrador') {
                inserirMensagem('você não tem o direito de fazer isso.','danger');
                header('location: index.php?acao=listar');
                return;    
            }
            $id = $_GET['id'];
            $resultado = excluirPrestador($id);
            if ($resultado) {
                inserirMensagem("Prestador de serviços excluído com sucesso", "success");
            } else {
                inserirMensagem("Não foi possível excluir o prestador selecionado", "warning");
            }
            header('location: index.php?acao=listar');
        break;

        case 'listar':
            $prestadores = lerPrestadores();
            include '../template/prestador-servico/listar.php';
        break;

        case 'novo':
            if ($usuario === false) {
                inserirMensagem('somente para usuários autenticados','warning');
                header('location: index.php?acao=listar');
                return;    
            }
            if ($_POST) {
                $nome = $_POST['nome'];
                $sobrenome = $_POST['sobrenome'];
                $email = $_POST['email'];
                $site = $_POST['website'];
                $dataInicial = $_POST['dataini'];
                $dataFinal = $_POST['datafim'];
                $regiao = $_POST['regiao'];
                $atividades = $_POST['atividade'];
                $arquivo = manipularArquivo('foto');
    
                if ($arquivo === false) {
                    inserirMensagem("arquivo de foto é inválido", "danger");                
                } else            
                if (empty(trim($nome))){
                    inserirMensagem("Nome não pode ser vazio", "danger");                
                } else {
                    adicionarPrestador($nome, 
                            $sobrenome,
                            $email,
                            $site,
                            $dataInicial,
                            $dataFinal,
                            $regiao,
                            $atividades,
                            $arquivo
                    );
                    inserirMensagem("Prestador $nome foi inserido com sucesso em nossas base de dados!", "success");
                }
                header('location: index.php?acao=listar');
            } else {
                include '../template/prestador-servico/adicionar.php';
            }
        break;
}