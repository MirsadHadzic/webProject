<?php
use OpenApi\Annotations as OA;
/**
 * @OA\Get(
 *     path="/todo",
 *     tags={"todos"},
 *     summary="Get todos",
 *     description="Retrieves a list of todos based on the user's role",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Todo")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

Flight::route("GET /todo", function(){
    $user = Flight::get('user');
    if($user['is_admin']){
        Flight::json(Flight::todo_service()->get_all());
    } else {
        Flight::json(Flight::todo_service()->get_user_todo($user));
    }
 });

/**
 * @OA\Get(
 *     path="/todo_by_id",
 *     tags={"todos"},
 *     summary="Get a specific todo by ID",
 *     description="Retrieves a specific todo based on the user's role and the provided ID",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="The ID of the todo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Todo")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

 Flight::route("GET /todo_by_id", function(){
     $user = Flight::get('user');
     if($user['is_admin']){
         Flight::json(Flight::todo_service()->get_by_id(Flight::request()->query['id']));
     } else {
         Flight::json(Flight::todo_service()->get_by_id_and_user($user, Flight::request()->query['id']));
     }
 });

/**
 * @OA\Get(
 *     path="/todo/{id}",
 *     tags={"todos"},
 *     summary="Get a specific todo by ID",
 *     description="Retrieves a specific todo based on the user's role and the provided ID",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the todo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Todo")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

 Flight::route("GET /todo/@id", function($id){
     $user = Flight::get('user');
     if($user['is_admin']){
         Flight::json(Flight::todo_service()->get_by_id($id));
     } else {
         Flight::json(Flight::todo_service()->get_by_id_and_user($user, $id));
     }
 });

/**
 * @OA\Delete(
 *     path="/todo/{id}",
 *     tags={"todos"},
 *     summary="Delete a specific todo by ID",
 *     description="Deletes a specific todo based on the user's role and the provided ID",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the todo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             properties={
 *                 "message": {
 *                     type="string",
 *                     example="todo deleted successfully"
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

 Flight::route("DELETE /todo/@id", function($id){
    $user = Flight::get('user');
    if($user['is_admin']){
        Flight::todo_service()->delete($id);
    } else {
        Flight::todo_service()->delete_todo($user, $id);
    }
    Flight::json(['message' => "todo deleted successfully"]);
 });

/**
 * @OA\Post(
 *     path="/todo",
 *     tags={"todos"},
 *     summary="Add a new todo",
 *     description="Adds a new todo based on the user's role and the provided request data",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TodoRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             properties={
 *                 "message": {
 *                     type="string",
 *                     example="todo added successfully"
 *                 },
 *                 "data": {
 *                     type="object",
 *                     ref="#/components/schemas/Todo"
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

 Flight::route("POST /todo", function(){
    $user = Flight::get('user');
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "todo added successfully",
                  'data' => Flight::todo_service()->add($request, $user)
                 ]);
 });


/**
 * @OA\Put(
 *     path="/todo/{id}",
 *     tags={"todos"},
 *     summary="Update a specific todo by ID",
 *     description="Updates a specific todo based on the user's role, the provided ID, and the request data",
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the todo",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/TodoRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             properties={
 *                 "message": {
 *                     type="string",
 *                     example="todo edit successfully"
 *                 },
 *                 "data": {
 *                     type="object",
 *                     ref="#/components/schemas/Todo"
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User is not authenticated"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden - User is not authorized to access this resource"
 *     )
 * )
 */

 Flight::route("PUT /todo/@id", function($id){
    $user = Flight::get('user');
    $todo = Flight::request()->data->getData();
    Flight::json(['message' => "todo edit successfully",
                  'data' => Flight::todo_service()->update($todo, $id, 'id', $user)
                 ]);
 });

 Flight::route("GET /todo/@name", function($name){
    echo "Hello from /todo route with name= ".$name;
 });

 Flight::route("GET /todo/@name/@status", function($name, $status){
    echo "Hello from /todo route with name = " . $name . " and status = " . $status;
 });

?>
