<?php

// ove dvije tacke su za Exit, da hocemo iz dao izaci, napravili bismo ovo, ../../vendor/autoload.php

require "../vendor/autoload.php";
require "dao/ProjectDao.class.php";

// flight register se koristi da ne bi ponavljali ovu instancu klase ProjectDaoClass... 
Flight::register('user_dao', "UsersDao");

Flight::route("/", function(){
   echo "Hello from / route";
});

// We need to return data in JSON format, because that will be our communication between frontend
// and backend
Flight::route("GET /users", function(){
   //echo "Hello from /students route";
   //echo "Hello from /students route with name= ".$name"; $name se posalje kao parametar u funkciji
   // kod ovoga iznad dodaje se /students/mirso  
   //$student_dao = new StudentsDao();
   //$results = Flight::student_dao()->get_all();
   //print_r($results);
   // dodati u header-u postman  content type application/json
   Flight::json(Flight::user_dao()->get_all());
   /*$memory_usage = memory_get_usage(); // get current memory usage
   echo "Current memory usage: " . $memory_usage . " bytes";*/
});

Flight::route("GET /user_by_id", function(){
   Flight::json(Flight::user_dao()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /users/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   //$results = $student_dao->get_by_id($id);
   //print_r($results);
   Flight::json(Flight::user_dao()->get_by_id($id));
});

Flight::route("DELETE /users/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   Flight::user_dao()->delete($id);
   Flight::json(['message' => "Student deleted successfully"]);
});
  
Flight::route("POST /user", function(){
    //echo "Hello from /students route";
    //$student_dao = new StudentsDao();
    // ovo getData da se ekstraktuju values iz arrayj-aj 
   $request = Flight::request()->data->getData();
   //$response = $student_dao->add($request);
   Flight::json(['message' => "Student added successfully",
                 'data' => Flight::user_dao()->add($request)
                ]);
});

Flight::route("PUT /user/@id", function($id){
   //echo "Hello from /students route";
   //$student_dao = new StudentsDao();
   $user = Flight::request()->data->getData();
   //$response = $student_dao->update($student, $id);
   Flight::json(['message' => "Student edit successfully",
                 'data' => Flight::student_dao()->update($user, $id)
                ]);
});

Flight::route("GET /users/@name", function($name){
   echo "Hello from /students route with name= ".$name;
});

Flight::route("GET /users/@name/@status", function($name, $status){
   echo "Hello from /students route with name = " . $name . " and status = " . $status;
});

// ide uvijek, da bi se startalo uopste*/
Flight::start();
?>
