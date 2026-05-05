<?php
    //cabeçalho
    header("Content-Type: application/json; charset=UTF-8"); // Define o tipo de resposta

    $metodo = $_SERVER['REQUEST_METHOD'];
    //echo "metodo de requisicao:" . $metodo;

    // recupera o arquivo json na mesma pasta do projeto
    $arquivo = 'usuarios.json';

    // verifica se o arquivo existe, se nao existir cria um com array vazio
    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $usuarios = json_decode(file_get_contents($arquivo), true);
    //$usuarios = [
      //  ["id" => 1, "nome" => "Maria Souza", "email" => "maria@gmail.com"],
        //["id" => 2, "nome" => "Joao Silva", "email" => "joao@gmail.com"]
    //];

    switch ($metodo) {
        case 'GET':
            //echo "AQUI AÇÕES DO METODO GET;";
            //CONVERTE PARA JSON E RETORNA
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;

        case 'POST':
            //echo "AQUI AÇÕES DO METODO POST;";
            //LER OS DADOS NO CORPO DA REQUISICAO
            $dados = json_decode(file_get_contents("php://input"), true);
            //print_r($dados);

            // VERIFICA SE OS CAMPOS OBRIGATORIOS FORAM PREENCHIDOS
            if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])) {
                http_response_code(400);
                echo json_encode(["erro" => "Dados incompletos"], JSON_UNESCAPED_UNICODE);
                exit;
            }
            // CRIA NOVO USUARIO
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            // ADICIONA AO ARRAY DE USUARIOS
            $usuarios [] = $novo_usuario;

            //SALVA O ARRAY ATUALIZADO NO ARQUIVO JSON
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            //RETORNA MENSAGEM DE SUCESSO
            echo json_encode(["mensagem" => "Usuario inserido com sucesso!" , "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
            break;

            // Adiciona o novo usuario ao array existente
            //array_push($usuarios, $novoUsuario);
            //echo json_encode('Uuario inserido com sucesso!');
            //print_r($usuarios);

            break;

        default:
            // echo "METODO NAO ENCONTRADO!";
            // break;
            http_response_code(405); // Metodo nao permitido
            echo json_encode(["erro" => "metodo nao permitido!"], JSON_UNESCAPED_UNICODE);
            break;

        case 'PUT':
            echo "AQUI AÇÕES DO METODO PUT;";
            break;

        case 'DELETE':
            echo "AQUI AÇÕES DO METODO DELETE;";
            break;
        
    }

?>
    