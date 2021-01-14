<?php
class Database {

    // укажите свои учетные данные базы данных 
    private $host       = "localhost";
    private $db_name    = "npars553_test";
    private $username   = "npars553_alex";
    private $password   = "Newsparser";
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