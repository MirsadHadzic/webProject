<?php
require("vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['C:/Bitnami/wampstack-8.1.2-0/apache2/htdocs/webProject2/rest']);

header('Content-Type: application/json');
echo $openapi->toJson();
