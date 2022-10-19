<?php
class Database {

    // укажите свои учетные данные базы данных 
    private $host       = "localhost";
    private $db_name    = "parser";
    private $username   = "izvekov";
    private $password   = "12345";
    public $conn;

    // получаем соединение с БД 
    public function getConnection(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $this->conn = new PDO($dsn, $this->username, $this->password);
        // $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->conn;
    }
}
?>