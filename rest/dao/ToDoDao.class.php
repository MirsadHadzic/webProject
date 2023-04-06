<?php

    require_once("BaseDao.class.php");

    class ToDoDao extends BaseDao
    {

        public function __construct(){
            parent::__construct("todo");
        }

        /*public function get_all(){
            return parent::get_all();
        }*/
        
    }

 ?>