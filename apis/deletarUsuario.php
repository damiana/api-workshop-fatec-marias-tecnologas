<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database e outros objetos
include_once '../config/database.php';
include_once '../obj_usuario/usuario.php';


// instancia uma conexao com banco de dados objeto usuario
$database = new Database();
$db = $database->getConnection();
 
// inicializa objeto usuario
$usuario = new Usuario($db);
 
$data = (object) $_POST; // usar com postman

// set ID do usuario a ser editado
$usuario->id = $data->id;

// seta valores para objeto usuario
if($usuario->deletarUsuario()){
 
    // seta o codigo http de resposta - 200 ok
    http_response_code(200);

    // mensagem de retorno apos sucesso
    echo json_encode(array("mensagem" => "Usuario deletado com sucesso."));
}

// Se nao foi possivel criar usuario, notificar
else{

    // seta codigo http de resposta - 503 service unavailable
    http_response_code(503);

    // mensagem de retorno apos erro
    echo json_encode(array("mensagem" => "Nao foi possivel deletar usuario."));
}
?>