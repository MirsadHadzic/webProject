<?php
// Instanca part
require_once("rest/dao/ProjectDao.class.php");
$todo_dao = new ToDoDao();

// za get 
$results = $todo_dao->get_all();
print_r($results);
/**/ 
// za add
$todo_name = $_REQUEST['todo_name'];
$todo_time = $_REQUEST['todo_time'];

$results2 = $todo_dao->add($todo_dao, $todo_time);
//print_r($results2);
// print_r(" Dodao sam tog i tog u bazu.");
/*
// za update
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$age = $_REQUEST['age'];
$id = $_REQUEST['id'];

$results = $user_dao->update($firstName, $lastName, $age, $id);
print_r($results);

// za delete
$id = $_REQUEST['id'];
$results = $user_dao->delete($id);
print_r($results);

// Instanca part
require_once("rest/dao/ProjectDao.class.php");
$user_dao = new UsersDao();

$type = $_REQUEST['type'];

switch ($type) {
    case 'add':
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $results = $user_dao->add($firstName, $lastName, $age);
        //print_r($results);
        break;
    
    case 'delete':
        $id = $_REQUEST['id'];
        $user_dao->delete($id);
        print_r($results);
        break;    

    case 'update':
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $age = $_REQUEST['age'];
        $results = $user_dao->update($firstName, $lastName, $age);
        //print_r($results);
        break;    
            
    default:
        $results = $user_dao->get_all();
        print_r($results);
        break;
}
*/
?>
