<?php
class Bot {

    // подключение к базе данных и таблице 'newss' 
    private $conn;
    private $table_name = "bot_flow";

    // свойства объекта 
    public $chat_id;
    public $user_id;
    public $last_message;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    // метод read() - получение записей
    function read(){

      // выбираем все записи 
      $query = "SELECT * FROM " . $this->table_name;
        
    
      // подготовка запроса 
      $stmt = $this->conn->prepare($query);

      // выполняем запрос 
      $stmt->execute();
      return $stmt;
    }

    // метод create 
    function create(){

      // запрос для вставки (создания) записей 
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                  chat_id = :chat_id, user_id = :user_id, last_message = :last_message";

      // подготовка запроса 
      $stmt = $this->conn->prepare($query);

      // очистка 
      $this->chat_id=htmlspecialchars(strip_tags($this->chat_id));
      $this->user_id=htmlspecialchars(strip_tags($this->user_id));
      $this->last_message=htmlspecialchars(strip_tags($this->last_message));
 
      // привязка значений 
      $stmt->bindParam(":chat_id", $this->chat_id);
      $stmt->bindParam(":user_id", $this->user_id);
      $stmt->bindParam(":last_message", $this->last_message);

      // выполняем запрос 
      if ($stmt->execute()) {
          return true;
      }
      
      return false;
    }


    // используется при заполнении формы обновления товара 
    function readOne() {

        // запрос для чтения одной записи (товара) 
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                     
                WHERE
                    `chat_id` = ? AND `user_id` = ?
                LIMIT
                    0,1";

        // подготовка запроса 
        $stmt = $this->conn->prepare( $query );

        // привязываем id товара, который будет обновлен 
        $stmt->bindParam(1, $this->chat_id);
        $stmt->bindParam(2, $this->user_id);

        // выполняем запрос 
        $stmt->execute();

        // получаем извлеченную строку 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // установим значения 
        if(!empty($row['chat_id']) AND !empty($row['user_id']) AND !empty($row['last_message'])){
            $this->chat_id = $this->chat_id;
            $this->user_id = $this->user_id;
            $this->last_message = $row['last_message'];
            return true;
        }
        else{
            return false;
        }
    }


    // метод update() - обновление товара 
    function update(){

        // запрос для обновления записи (товара) 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    last_message = :last_message
                WHERE
                    chat_id = :chat_id && user_id = :user_id";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->chat_id=htmlspecialchars(strip_tags($this->chat_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->last_message=htmlspecialchars(strip_tags($this->last_message)); 

        // привязываем значения 
        $stmt->bindParam(':chat_id', $this->chat_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':last_message', $this->last_message);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // метод delete - удаление товара 
    function delete(){

        // запрос для удаления записи (товара) 
        $query = "DELETE FROM " . $this->table_name . " WHERE `chat_id`= ? AND `user_id` = ?";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->chat_id=htmlspecialchars(strip_tags($this->chat_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // привязываем id записи для удаления 
        $stmt->bindParam(1, $this->chat_id);
        $stmt->bindParam(2, $this->user_id);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
 
    // используется при заполнении формы обновления товара 
    function isExists() {

        // запрос для чтения одной записи (товара) 
        $query = "SELECT
                    COUNT(*) AS result
                FROM
                    " . $this->table_name . "
                        
                WHERE
                    `chat_id` = ? AND `user_id` = ?
                LIMIT
                    0,1";

        // подготовка запроса 
        $stmt = $this->conn->prepare( $query );

        // привязываем id товара, который будет обновлен 
        $stmt->bindParam(1, $this->chat_id);
        $stmt->bindParam(2, $this->user_id);

        // выполняем запрос 
        $stmt->execute();

        // получаем извлеченную строку 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['result'] != 0){
            return true;
        }
        return false;
    }
    
}
?>