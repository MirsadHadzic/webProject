<?php

// ove dvije tacke su za Exit, da hocemo iz dao izaci, napravili bismo ovo, ../../vendor/autoload.php

require "../vendor/autoload.php";
require "services/ToDoService.php";

// flight register se koristi da ne bi ponavljali ovu instancu klase StudentsDaoClass... 
Flight::register('todo_service', "ToDoService");

require_once('routes/ToDoRoutes.php');

// ide uvijek, da bi se startalo uopste*/
Flight::start();
?>
