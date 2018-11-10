<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database e outros objetos
include_once '../config/database.php';
include_once '../obj_usuario/usuario.php';

// instancia uma conexao com banco de dados objeto usuario
$database = new Database();
$db = $database->getConnection();
 
// inicializa objeto usuario
$usuario = new Usuario($db);


$data = (object) $_POST; // usar com postman

// set valores para objeto usuario
$usuario->nome = $data->nome;
$usuario->idade = $data->idade;
$usuario->endereco = $data->endereco;
$usuario->telefone = $data->telefone;
$usuario->email = $data->email;
$usuario->cpf = $data->cpf;
$usuario->senha = $data->senha;

// seta valores para objeto usuario
if($usuario->cadastrarUsuario()){
 
    // seta o codigo http de resposta - 201 created
    http_response_code(201);

    // mensagem de retorno apos sucesso
    echo json_encode(array("mensagem" => "Usuario criado com sucesso."));
}

// Se nao foi possivel criar usuario, notificar
else{

    // seta codigo http de resposta - 503 service unavailable
    http_response_code(503);

    // mensagem de retorno apos erro
    echo json_encode(array("mensagem" => "Nao foi possivel criar usuario."));
}
?>