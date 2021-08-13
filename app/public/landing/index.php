<?php
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
$uri = explode( '/', $uri );
echo $uri;
?>
