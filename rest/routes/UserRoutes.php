<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/login",
 *     tags={"authentication"},
 *     summary="User login",
 *     description="Logs in a user based on the provided email and password",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", example="mirsad.hadzic@stu.ibu.edu.ba"),
 *             @OA\Property(property="password", type="string", example="ocu366m8")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful login",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTIzNDU2Nzg5MCwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found or wrong password",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Wrong password")
 *         )
 *     )
 * )
 */


Flight::route('POST /login', function(){
  //echo "<script>console.log('connected: ' );</script>";
    $login = Flight::request()->data->getData();
 
    $user = Flight::userDao()->get_user_by_email($login['email']);
    if(count($user) > 0){
        $user = $user[0];
    }
    if (isset($user['id'])){
      if($user['password'] == md5($login['password'])){
        unset($user['password']);
        $user['is_admin'] = false;
        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token' => $jwt]);
      }else{
        Flight::json(["message" => "Wrong password"], 404);
      }
    }else{
      Flight::json(["message" => "User doesn't exist"], 404);
  }
});
?>
