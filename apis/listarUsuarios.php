<?php
// requer headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// includes database e outros objetos
include_once '../config/database.php';
include_once '../obj_usuario/usuario.php';

// instancia uma conexao com banco de dados objeto usuario
$database = new Database();
$db = $database->getConnection();
 
// inicializa objeto usuario
$usuario = new Usuario($db);

// query usuario
$stmt = $usuario->listarUsuarios();
$num = $stmt->rowCount();

// verifica registro foi encontrado
if($num>0){
 
    // usuario array
    $usuarios_arr=array();
    $usuarios_arr["usuarios"]=array();
 
    // recuperar o conteúdo da nossa tabela
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extrai linha
        extract($linha);
 
        $usuario_item=array(
            "id" => $id,
            "nome" => $nome,
            "idade" => $idade,
            "endereco" => $endereco,
            "telefone" => $telefone,
            "email" => $email,
            "cpf" => $cpf,
            "senha" => $senha
        );
        array_push($usuarios_arr["usuarios"], $usuario_item);
    }
    echo json_encode($usuarios_arr);
}
 
else{
    echo json_encode(
        array("mensagem:" => "Não há usuarios cadastrados.")
    );
}
?>