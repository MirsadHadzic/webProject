<?php
require_once "BaseDao.class.php";

class ToDoDao extends BaseDao {
    
    private $table_name = "todo";

    public function __construct(){
        parent::__construct($this->table_name);
    }

    public function get_user_todo($user_id){
        return $this->query('SELECT * FROM `web-project`.' . $this->table_name . ' WHERE user_id = :user_id', ['user_id' => $user_id]);
    }

    public function get_by_id_and_user($user_id, $id){
        return $this->query_unique('SELECT * FROM `web-project`.' . $this->table_name . ' WHERE user_id = :user_id AND id=:id', ['user_id' => $user_id, 'id' => $id]);
    }

    public function delete_todo($user_id, $id){
        return $this->delete_query($user_id, $id);
    }
}
?>
