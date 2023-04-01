<?php

/**
 * Summary of UsersDao
 */
class UsersDao
{

    /**
     * Summary of conn
     * @var
     */
    private $conn;

    /*
    * Class constructor used to establish connection to db
    */ 

    /**
     * Summary of __construct
     */
    public function __construct(){
        try {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $schema = "lab3_db";

            $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

    /*
    * Method used to get all users from database  
    */
    /**
     * Summary of get_all
     * @return array
     */
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
    * Method used to get student by id from database
    */
    public function get_by_id($id){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }


    /*
    * Method used to add users to database  
    * string $first_name: First name is the first name of the user
    */
    /*public function add($firstName, $lastName, $age){
        $stmt = $this->conn->prepare("INSERT INTO users (firstName, lastName, age) 
        VALUES ('$firstName', '$lastName', '$age')");
        $result = $stmt->execute();
    }*/

    /**
     * Summary of add
     * @param mixed $user
     * @return mixed
     */
    public function add($user){
        $stmt = $this->conn->prepare("INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)");
        $stmt->execute($user);
        $user['id'] = $this->conn->lastInsertId();
        return $user;
    }

    /*
    * Method used to update users to database  
    */
    /*public function update($firstName, $lastName, $age, $id){
        $stmt = $this->conn->prepare("UPDATE users SET firstName = '$firstName', 
        lastName = '$lastName', age = '$age' WHERE id = $id");
        $result = $stmt->execute();
    }*/

    /**
     * Summary of update
     * @param mixed $user
     * @param mixed $id
     * @return mixed
     */
    public function update($user, $id){
        $user['id'] = $id;
        $stmt = $this->conn->prepare("UPDATE users SET firstName = :firstName, lastName= :lastName, age = :age WHERE id=:id");
        $stmt->execute($user);
        return $user;
    }

    /*
    * Method used to delete users from database  
    */
    /**
     * Summary of delete
     * @param mixed $id
     * @return void
     */
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>