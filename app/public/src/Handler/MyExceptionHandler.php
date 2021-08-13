<?php
namespace Src\Handler;

use Src\Core\Exception\RoutingException;
use Src\Core\Exception\RoutingNotFoundException;
use Src\Core\Handler\ExceptionHandler;
use Src\Core\Handler\SillyExceptionHandlerInterface;

class MyExceptionHandler implements SillyExceptionHandlerInterface {
  
    public static function register()
    {
        ExceptionHandler::register(RoutingNotFoundException::class, function($exception) {
            echo json_encode(array("error" => "Not found"));
        });

        ExceptionHandler::register(RoutingException::class, function($exception) {
            echo json_encode(array("error" => "Duplicated route"));
        });
    }
}