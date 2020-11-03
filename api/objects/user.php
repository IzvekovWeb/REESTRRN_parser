<?php
class Userx {

    // подключение к базе данных и таблице 'usersx' 
    private $conn;
    private $table_name = "usersx";

    // свойства объекта 
    public $id;
    public $loginx;
    public $passwordx;
    public $name;
    public $hash;
    public $email;
    public $email_confirned;
    public $reg_date;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    // метод read() - получение информации о всех пользователях
    function read(){

      // выбираем все записи 
      $query = "SELECT * FROM " . $this->table_name . " ORDER BY `reg_date` DESC";
        
    
      // подготовка запроса 
      $stmt = $this->conn->prepare($query);

      // выполняем запрос 
      $stmt->execute();
      return $stmt;
    }

    // метод create - добавить пользователя
    function create(){

      // запрос для вставки (создания) пользователя 
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                loginx = :loginx, 
                passwordx = :passwordx, 
                name = :name, 
                hash = :hash, 
                email = :email,
                email_confirned = :email_confirned, 
                reg_date = :reg_date, 
                ";

      // подготовка запроса 
      $stmt = $this->conn->prepare($query);

      // очистка 
      $this->loginx=htmlspecialchars(strip_tags($this->loginx));
      $this->passwordx=htmlspecialchars(strip_tags($this->passwordx));
      $this->name=htmlspecialchars(strip_tags($this->name));
      $this->hash=htmlspecialchars(strip_tags($this->hash));
      $this->email=htmlspecialchars(strip_tags($this->email));
      $this->email_confirned=htmlspecialchars(strip_tags($this->email_confirned));
      $this->reg_date=htmlspecialchars(strip_tags($this->reg_date));
 
      // привязка значений 
      $stmt->bindParam(":loginx", $this->loginx);
      $stmt->bindParam(":passwordx", $this->passwordx);
      $stmt->bindParam(":name", $this->name); 
      $stmt->bindParam(":hash", $this->hash); 
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":email_confirned", $this->email_confirned); 
      $stmt->bindParam(":reg_date", $this->reg_date);

      // выполняем запрос 
      if ($stmt->execute()) {
          return true;
      }
      
      return false;
    }


    // Получение инф. об 1 пользователе
    function readOne($user_id) {

        // запрос для чтения одной записи (товара) 
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                     
                WHERE id = ?";

        // подготовка запроса 
        $stmt = $this->conn->prepare( $query );

        // привязываем id товара, который будет обновлен 
        $stmt->bindParam(1, $this->$user_id);

        // выполняем запрос 
        $stmt->execute();

        // получаем извлеченную строку 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // установим значения свойств объекта 
        $this->loginx           = $row['loginx'];
        $this->name             = $row['name'];
        $this->hash             = $row['hash'];
        $this->email            = $row['email'];
        $this->email_confirned  = $row['email_confirned'];
        $this->reg_date         = $row['reg_date'];
    }


    // метод update() - изменение данных пользователя
    function update(){

        // запрос для обновления записи (товара) 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    loginx = :loginx, 
                    passwordx = :passwordx, 
                    name = :name, 
                    hash = :hash, 
                    email = :email,
                    email_confirned = :email_confirned, 
                    reg_date = :reg_date, 
                WHERE
                    id = :id";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

      // очистка 
      $this->id=htmlspecialchars(strip_tags($this->id));

      $this->loginx=htmlspecialchars(strip_tags($this->loginx));
      $this->passwordx=htmlspecialchars(strip_tags($this->passwordx));
      $this->name=htmlspecialchars(strip_tags($this->name));
      $this->hash=htmlspecialchars(strip_tags($this->hash));
      $this->email=htmlspecialchars(strip_tags($this->email));
      $this->email_confirned=htmlspecialchars(strip_tags($this->email_confirned));
      $this->reg_date=htmlspecialchars(strip_tags($this->reg_date));
 
      // привязка значений 
      $stmt->bindParam(":id", $this->loginx);
      $stmt->bindParam(":loginx", $this->loginx);
      $stmt->bindParam(":passwordx", $this->passwordx);
      $stmt->bindParam(":name", $this->name); 
      $stmt->bindParam(":hash", $this->hash); 
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":email_confirned", $this->email_confirned); 
      $stmt->bindParam(":reg_date", $this->reg_date);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // метод delete - удаление товара 
    function delete(){

        // запрос для удаления записи (товара) 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);

        // очистка 
        $this->id=htmlspecialchars(strip_tags($this->id));

        // привязываем id записи для удаления 
        $stmt->bindParam(1, $this->id);

        // выполняем запрос 
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // метод search - поиск товаров 
    function search($keywords){ 

        // выборка по всем записям 
        $query = "SELECT
                   *
                FROM
                    " . $this->table_name . " 
                   
                WHERE
                    loginx LIKE ? OR name LIKE ?
                ORDER BY
                    time DESC";

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
 
        // очистка 
        foreach ($keywords as $keyword) {
            $keyword = htmlspecialchars(strip_tags($keyword));
            $keyword = "%{$keyword}%";
        } 


        // привязка 
        $stmt->bindParam(1, $keywords['loginx']);
        $stmt->bindParam(2, $keywords['name']);

        // выполняем запрос 
        $stmt->execute(); 

       return $stmt;
    }
}
?>