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
            echo json_encode($usuarios);
            break;

        case 'POST':
            //echo "AQUI AÇÕES DO METODO POST;";
            $dados = json_decode(file_get_contents("php://input"), true);
            //print_r($dados);
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            // Adiciona o novo usuario ao array existente
            array_push($usuarios, $novoUsuario);
            echo json_encode('Uuario inserido com sucesso!');
            print_r($usuarios);

            break;

        case 'PUT':
            echo "AQUI AÇÕES DO METODO PUT;";
            break;

        case 'DELETE':
            echo "AQUI AÇÕES DO METODO DELETE;";
            break;
        
        default:
            echo "METODO NAO ENCONTRADO";
            break;
    }
    

    // Converte para JSON e retorna
    

?>
    