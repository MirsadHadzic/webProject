<?php

class ToDoDao{

    private $conn;

    /**
    * Class constructor used to establish connection to db
    */
    public function __construct(){
        try {
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $schema = "project";
          $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
    * Method used to get all students from database
    */
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM todo");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Method used to get student by id from database
    */
    public function get_by_id($id){
        $stmt = $this->conn->prepare("SELECT * FROM todo WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    /**
    * Method used to get add student to database
    * string $first_name: First name is the first name of the student
    */
    public function add($todo){
        $stmt = $this->conn->prepare("INSERT INTO todo (todo_name, todo_time) VALUES (:todo_name, :todo_time)");
        $stmt->execute($todo);
        $todo['id'] = $this->conn->lastInsertId();
        return $todo;
    }

    /**
    * Method used to get update student from database
    */
    public function update($todo, $id){
        $todo['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE todo SET todo_name = :todo_name, todo_time=:todo_time WHERE id=:id");
        $stmt->execute($todo);
        return $todo;
    }

    /**
    * Method used to get delete student from database
    */
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM todo WHERE id = :id");
        $stmt->bindParam(':id', $id); #prevent SQL injection
        $stmt->execute();
    }
}



 ?>
