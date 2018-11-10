<?php
class Usuario {

    // conexao com banco de dados
    private $conn;

    // objeto usuario
    public $id;
    public $nome;
    public $idade;
    public $endereco;
    public $telefone;
    public $email;
    public $cpf;
    public $senha;


    // construtor com $db para acesso ao banco de dados
    public function __construct($db){
        $this->conn = $db;
    }

    // obtem a lista de usuarios
    function listarUsuarios(){
        $query = "SELECT * FROM usuario";
        
        // preparar instrução de consulta
        $stmt = $this->conn->prepare($query);

        // executa query
        $stmt->execute();

        return $stmt;
    }

    function cadastrarUsuario() {
        
        $query = "INSERT INTO usuario
            SET
                nome = :nome,
                idade = :idade,
                endereco = :endereco,
                telefone = :telefone,
                email = :email,
                cpf = :cpf,
                senha = :senha";

        // preparar instrução de gravar
        $stmt = $this->conn->prepare($query);

        //campos a serem gravados na ordem
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':senha', $this->senha);

        // executa query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function alterarUsuario() {

        $query = "UPDATE usuario
        SET
            nome = :nome,
            idade = :idade,
            endereco = :endereco,
            telefone = :telefone,
            email = :email,
            cpf = :cpf,
            senha = :senha
        WHERE id = :id";

        // preparar instrução de update
        $stmt = $this->conn->prepare($query);

        //campos a serem alterados na ordem
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':senha', $this->senha);

        // executa query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function deletarUsuario() {

        $query = "DELETE FROM usuario WHERE id = ?";

        // preparar instrução de delete
        $stmt = $this->conn->prepare($query);

        //registro para deletar
        $stmt->bindParam(1, $this->id);

         // executa query
        if($stmt->execute()){
            return true;
        }
 
        return false;
    }
}
?>