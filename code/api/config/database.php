<?php

$DEBUG = true;

class Database {

    // укажите свои учетные данные базы данных 
    private $host = "127.0.0.1";
    private $db_name = "parser";
    private $username;
    private $password;
    public $conn;

    function __construct($DEBUG = true){
        if ($DEBUG){
            $this->username   = "izvekov";
            $this->password   = "12345";
        } else {
            $this->username   = "parser_user";
            $this->password   = "12345";
        }
    }

    // получаем соединение с БД 
    public function getConnection($DEBUG){
        $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->db_name;
        $this->conn = new PDO($dsn, $this->username, $this->password);
        // $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->conn;
    }
}
?>