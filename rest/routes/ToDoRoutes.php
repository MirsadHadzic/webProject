<?php

Flight::route("/", function(){
   echo "Hello from / route";
});

Flight::route("GET /todo", function(){
   Flight::json(Flight::todo_service()->get_all());
});

Flight::route("GET /todo_by_id", function(){
   Flight::json(Flight::todo_service()->get_by_id(Flight::request()->query['id']));
});

Flight::route("GET /todo/@id", function($id){
   Flight::json(Flight::todo_service()->get_by_id($id));
});

Flight::route("DELETE /todo/@id", function($id){
   Flight::todo_service()->delete($id);
   Flight::json(['message' => "ToDo deleted successfully"]);
});

Flight::route("POST /todo", function(){
   $request = Flight::request()->data->getData();
   Flight::json(['message' => "ToDo added successfully",
                 'data' => Flight::todo_service()->add($request)
                ]);
});

Flight::route("PUT /todo/@id", function($id){
   $todo = Flight::request()->data->getData();
   Flight::json(['message' => "ToDo edit successfully",
                 'data' => Flight::todo_service()->update($todo, $id)
                ]);
});

Flight::route("GET /todo/@name", function($name){
   echo "Hello from /todo route with name= ".$name;
});

Flight::route("GET /todo/@name/@status", function($name, $status){
   echo "Hello from /todo route with name = " . $name . " and status = " . $status;
});

Flight::start();
?>
