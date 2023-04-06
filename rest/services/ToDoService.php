<?php
require_once('BaseService.php');
require_once __DIR__."/../dao/ToDoDao.class.php";
class ToDoService extends BaseService
{
    // private $student_dao;
    public function __construct(){
        // $this->student_dao = new StudentsDao;
        parent::__construct(new ToDoDao);
    }

    public function add($entity){
        return parent::add($entity);
        // send an email
        /*if (!validateField($entity['first_name'])){
            error;
        }*/
    }
}

?>