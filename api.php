<?php
    //cabeçalho
    header("Content-Type: application/json"); // Define o tipo de resposta

    $metodo = $_SERVER['REQUEST_METHOD'];

    //echo "Metodo da requisicao: " ,$metodo;

    switch ($metodo) {
        case 'GET':
            echo "AQUI AÇÕES DO METODO GET;";
            break;

        case 'POST':
            echo "AQUI AÇÕES DO METODO POST;";
            break;
        
        default:
            echo "METODO NAO ENCONTRADO";
            break;
    }
    //Conteudo
    //$usuarios = [
    //    ["id" => 1, "nome" => "Maria Souza", "email" => "maria@gmail.com"],
    //   ["id" => 2, "nome" => "Joao Silva", "email" => "joao@gmail.com"]
    //];

    // Converte para JSON e retorna
    //echo json_encode($usuarios);

?>
    