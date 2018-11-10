
<?php
class Database{
 
    // credenciais para acesso a base de dados
    private $host = "localhost";
    private $db_name = "workshop_perfil";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get conexao da base de dados
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>