<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/ToDoDao.class.php";

class TodoService extends BaseService{
    public function __construct(){
        parent::__construct(new ToDoDao);
    }

    public function get_user_todo($user){
        return $this->dao->get_user_todo($user['id']);
    }

    public function get_by_id_and_user($user, $id){
        return $this->dao->get_by_id_and_user($user['id'], $id);
    }

    public function delete_todo($user, $id){
        return $this->dao->delete_todo($user['id'], $id);
    }

    public function update($todo, $id, $id_column="id", $user = null){
        if($user){
            $todo['user_id'] = $user['id'];
        }
        if(isset($todo['id_column'])  && !is_null($todo['id_column'])){
            return parent::update($todo, $id, $todo['id_column']);
        }
        return parent::update($todo, $id);
    }

    public function add($entity, $user = null){
        //unset($entity['phone']);
        if($user){
            $entity['user_id'] = $user['id'];
        }
        //$entity['password'] = md5($entity['password']);
        return parent::add($entity);
        /*
        example
        send an email
        if(!validateField($entity['first_name'])){
            //error
        }
        */
    }
}
?>
