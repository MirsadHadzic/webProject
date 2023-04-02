<?php
require "../vendor/autoload.php";
require "dao/ProjectDao.class.php";

Flight::register('todo_dao', "ToDoDao");

Flight::route("/", function(){
   echo "Hello from / route";
});

Flight::route("GET /todo", function(){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   //$results = Flight::student_dao()->get_all();
   //print_r($results);
   Flight::json(Flight::todo_dao()->get_all());
});

Flight::route("GET /todo_by_id", function(){
   Flight::json(Flight::todo_dao()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /todo/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   //$results = $student_dao->get_by_id($id);
   //print_r($results);
   Flight::json(Flight::todo_dao()->get_by_id($id));
});

Flight::route("DELETE /todo/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   Flight::todo_dao()->delete($id);
   Flight::json(['message' => "ToDo deleted successfully"]);
});

Flight::route("POST /todo", function(){
   //echo "Hello from /students route";
  //$student_dao = new StudentsDao();
   $request = Flight::request()->data->getData();
   //$response = $student_dao->add($request);
   Flight::json(['message' => "ToDo added successfully",
                 'data' => Flight::todo_dao()->add($request)
                ]);
});

Flight::route("PUT /todo/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   $todo = Flight::request()->data->getData();
   //$response = $student_dao->update($student, $id);
   Flight::json(['message' => "ToDo edit successfully",
                 'data' => Flight::todo_dao()->update($todo, $id)
                ]);
});

Flight::route("GET /todo/@name", function($name){
   echo "Hello from /students route with name= ".$name;
});

Flight::route("GET /todo/@name/@status", function($name, $status){
   echo "Hello from /students route with name = " . $name . " and status = " . $status;
});

Flight::start();
?>
