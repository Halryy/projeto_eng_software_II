<?php
    define('ARQUIVO_PRESTADOR','/xampp/htdocs/prestador/dados/prestador.json');
    define('ARQUIVO_USUARIO','/xampp/htdocs/prestador/dados/usuario.json');
    define('DIR_FOTO','/xampp/htdocs/prestador/fotos/');    
    define('LIMITE_FOTO', 1572864);

    function lerJson($arquivo) {
        $conteudo = file_get_contents($arquivo);
        if ($conteudo == '') {
            $conteudo ='[]';
        }
        $jsonArray = json_decode($conteudo,true);
        return $jsonArray;
    }

    function salvarJson($dados, $arquivo) {
        $manipulador = fopen($arquivo,'w+');
        fwrite($manipulador, json_encode($dados));
        fclose($manipulador);
    }   
    
    function lerPrestadores() {
        return lerJson(ARQUIVO_PRESTADOR);
    }

    function lerUsuarios() {
        return lerJson(ARQUIVO_USUARIO);
    }
        
    
    function lerPrestador($id) {
        $prestadores = lerPrestadores();
        if (isset($prestadores[$id])) {
            return $prestadores[$id];
        }
        return false;
    }

    function lerUsuario($id) {
        $usuarios = lerUsuarios();
        if (isset($usuarios[$id])) {
            return $usuarios[$id];
        }
        return false;
    }


    function adicionarUsuario($nome,$login,$tipo,$senha) {
        $usuarios = lerUsuarios();
        $usuarios[] = [
            'nome' => $nome,
            'login' => $login,
            'tipo' => $tipo,
            'senha' => $senha
        ];
        salvarJson($usuarios, ARQUIVO_USUARIO);
        return true;
    }

    function editarUsuario($id,$nome,$login,$tipo,$senha) {
        $usuarios = lerUsuarios();
        if (isset($usuarios[$id])) {
            $senha = $senha !== false ? $senha : $usuarios[$id]['senha'];
            $usuarios[$id] = [
                'nome' => $nome,
                'login' => $login,
                'tipo' => $tipo,
                'senha' => $senha
                ];
            salvarJson($usuarios, ARQUIVO_USUARIO);
            return true;
        }
        return false;
    }


    function adicionarPrestador($nome,$sobrenome,$email,$site,$dataInicial,
            $dataFinal,$regiao,$atividades, $arquivo) {
        $prestadores = lerPrestadores();
        $prestadores[] = [
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'email' => $email,
            'site' => $site,
            'dataInicial' => $dataInicial,
            'dataFinal' => $dataFinal,
            'regiao' => $regiao,
            'atividades' => $atividades,
            'foto' => $arquivo
        ];
        salvarJson($prestadores, ARQUIVO_PRESTADOR);
        return true;
    }
    
    function editarPrestador($id,$nome,$sobrenome,$email,$site,$dataInicial,
            $dataFinal,$regiao,$atividades, $arquivo) {
        $prestadores = lerPrestadores();
        if (isset($prestadores[$id])) {
            $arquivo = $arquivo !== false ? $arquivo : $prestadores[$id]['foto'];
            $prestadores[$id] = [
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'email' => $email,
            'site' => $site,
            'dataInicial' => $dataInicial,
            'dataFinal' => $dataFinal,
            'regiao' => $regiao,
            'atividades' => $atividades,
            'foto' => $arquivo
            ];
            salvarJson($prestadores, ARQUIVO_PRESTADOR);
            return true;
        }
        return false;
    }
    
    function excluirPrestador($id) {
        $prestadores= lerPrestadores();
        if (isset($prestadores[$id])) {
            unset($prestadores[$id]);
            salvarJson($prestadores, ARQUIVO_PRESTADOR);
            return true;
        }
        return false;
    }
    
    function excluirUsuario($id) {
        $usuarios = lerUsuarios();

        if (isset($usuarios[$id])) {
            unset($usuarios[$id]);
            salvarJson($usuarios, ARQUIVO_USUARIO);
            return true;
        }
        return false;
    }

    function inserirMensagem($mensagem, $tipo = 'success') {
        $_SESSION['mensagem'] = [
            'mensagem' => $mensagem,
            'tipo' => $tipo
        ];
    }
    
    function lerMensagem() {
        if (isset($_SESSION['mensagem'])) {
            $mensagem = $_SESSION['mensagem'];
            unset($_SESSION['mensagem']);
            return $mensagem;
        } 
        return false;
    }

    function manipularArquivo($nome) {
        if (isset($_FILES[$nome]) && $_FILES[$nome]['error'] == 0) {
            $arquivo = $_FILES[$nome]['tmp_name'];
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $info = $finfo->file($arquivo);
            $extensoes = [
                'png' => 'image/png',
                'jpeg' => 'image/jpg',
                'jpg' => 'image/jpeg',
            ];

            $tamanho = $_FILES[$nome]['size'];

            if ($tamanho > LIMITE_FOTO) {
                return false;
            }

            $extensao = array_search($info, $extensoes);
            if ($extensao !== false) {
                $destino = time().'-'.sha1_file($arquivo).'.'.$extensao;
                move_uploaded_file($arquivo, DIR_FOTO.$destino);
                return ['src' => $destino, 'mime' => $info];
            }
        }
        return false;
    }

    function existeArquivo($nome) {
        return isset($_FILES[$nome]) && $_FILES[$nome]['error'] != UPLOAD_ERR_NO_FILE;
    }


    function obterUsuarioAutenticado() {
        $usuarioAutenticado = $_SESSION['usuario'] ?? false;
        return $usuarioAutenticado;
    }

    function autenticar($login, $senha) {
        $usuarios = lerUsuarios();
        foreach($usuarios as $usuario) {
            if ($usuario['login'] == $login && $usuario['senha'] == $senha) {
                $_SESSION['usuario'] = $usuario;
                return true;
            }
        }   
        return false;
    }

    function sair() {
        unset($_SESSION['usuario']);
    }