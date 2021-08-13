<?php
require_once './src/Core/Boot/BootUp.php';

use Src\Core\Route\Router;


// required headers
// $products_arr=array( 
//     "name"=>"Danh",
//     "age"=>23,
//     "gender"=>"Female"
// );
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// echo json_encode($products_arr);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$param = $_SERVER['QUERY_STRING'];
// $uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];

Router::process($uri, $requestMethod);
// // $controller = new API($requestMethod, $param);
// // $controller->processRequest();
// // try {
//     Router::route($uri,$requestMethod, function($rm, $pr) {
//         $controller = new API($rm, $pr);
//         $controller->processRequest();
//     });
// // } catch (Exception $e) {
// //     echo 'Caught exception: ',  $e->getMessage(), "\n";
// // }
