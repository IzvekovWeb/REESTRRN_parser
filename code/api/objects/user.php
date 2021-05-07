<?php
class Userx {

    // подключение к базе данных и таблице 'usersx' 
    private $conn;
    private $table_name = "usersx";

    // свойства объекта 
    public $id;
    public $loginx;
    public $passwordx;
    public $first_name;
    public $second_name;
    public $status;
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
                first_name = :first_name, 
                second_name = :second_name, 
                status = :status 
                ";

      // подготовка запроса 
      $stmt = $this->conn->prepare($query);

      // очистка 
      $this->loginx         =htmlspecialchars(strip_tags($this->loginx));
      $this->passwordx      =htmlspecialchars(strip_tags($this->passwordx));
      $this->first_name     =htmlspecialchars(strip_tags($this->first_name));
      $this->second_name    =htmlspecialchars(strip_tags($this->second_name));
      $this->status         =htmlspecialchars(strip_tags($this->status));
    //   $this->reg_date       =htmlspecialchars(strip_tags($this->reg_date));
    //   $this->email          =htmlspecialchars(strip_tags($this->email));
    //   $this->email_confirned=htmlspecialchars(strip_tags($this->email_confirned));
 
      // привязка значений 
      $stmt->bindParam(":loginx", $this->loginx);
      $stmt->bindParam(":passwordx", $this->passwordx);
      $stmt->bindParam(":first_name", $this->first_name); 
      $stmt->bindParam(":second_name", $this->second_name); 
      $stmt->bindParam(":status", $this->status); 

      // выполняем запрос 
      if ($stmt->execute()) {
          return true;
      }
      
      return false;
    }


    // Получение инф. об 1 пользователе
    function getUser($user_id) {

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
        $this->first_name       = $row['first_name'];
        $this->second_name      = $row['second_name'];
        $this->status           = $row['status'];
        $this->reg_date         = $row['reg_date'];
    }
 
    // обновить запись пользователя 
    public function update(){
    
        // Если в HTML-форме был введен пароль (необходимо обновить пароль) 
        $password_set=!empty($this->passwordx) ? ", passwordx = :passwordx" : "";
    
        // если не введен пароль - не обновлять пароль 
        $query = "UPDATE " . $this->table_name . "
                SET
                    first_name = :first_name,
                    second_name = :second_name,
                    loginx = :loginx,
                    status = :status
                    {$password_set}
                WHERE id = :id";
    
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
    
        // инъекция (очистка) 
        $this->first_name   =htmlspecialchars(strip_tags($this->first_name));
        $this->second_name  =htmlspecialchars(strip_tags($this->second_name));
        $this->loginx       =htmlspecialchars(strip_tags($this->loginx));
        $this->status       =htmlspecialchars(strip_tags($this->status));
    
        // привязываем значения с HTML формы 
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':second_name', $this->second_name);
        $stmt->bindParam(':loginx', $this->loginx);
        $stmt->bindParam(':status', $this->status);
    
        // метод password_hash () для защиты пароля пользователя в базе данных 
        if(!empty($this->passwordx)){
            $this->passwordx=htmlspecialchars(strip_tags($this->passwordx));
            $password_hash = password_hash($this->passwordx, PASSWORD_BCRYPT);
            $stmt->bindParam(':passwordx', $password_hash);
        }
    
        // уникальный идентификатор записи для редактирования 
        $stmt->bindParam(':id', $this->id);
    
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных 
        if($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    

    // Проверка, существует ли логин в нашей базе данных 
    function loginExists(){
    
        // запрос, чтобы проверить, существует ли логин
        $query = "SELECT *
                FROM " . $this->table_name . "
                WHERE loginx = ?
                LIMIT 0,1";
    
        // подготовка запроса 
        $stmt = $this->conn->prepare( $query );
    
        // инъекция 
        $this->loginx=htmlspecialchars(strip_tags($this->loginx));
    
        // привязываем значение e-mail 
        $stmt->bindParam(1, $this->loginx);
    
        // выполняем запрос 
        $stmt->execute();
         
        // получаем количество строк 
        $num = $stmt->rowCount();
    
        // если логин существует, 
        // присвоим значения свойствам объекта для легкого доступа и использования для php сессий 
        if($num>0) {
    
            // получаем значения 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // присвоим значения свойствам объекта 
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->second_name = $row['second_name'];
            $this->passwordx = $row['passwordx'];
            $this->status = $row['status'];
            $this->reg_date = $row['reg_date'];
    
            // вернём 'true', потому что в базе данных существует логин
            return true;
        }
    
        // вернём 'false', если логин не существует в базе данных 
        return false;
    } 
 
    // метод delete - удаление пользователя 
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

    // метод search - поиск пользователя 
    function search($keywords){ 

        // выборка по всем записям 
        $query = "SELECT
                   *
                FROM
                    " . $this->table_name . " 
                   
                WHERE
                    loginx LIKE ? OR first_name LIKE ? OR second_name LIKE ?
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
        $stmt->bindParam(2, $keywords['first_name']);
        $stmt->bindParam(3, $keywords['second_name']);

        // выполняем запрос 
        $stmt->execute(); 

       return $stmt;
    }
}
?>