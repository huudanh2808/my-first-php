<?php

namespace Src\Controller;

use Src\Core\Route\Router;
use Src\Core\Controller\SillyControllerInterface;


class UserController implements SillyControllerInterface
{
  public static function register()
  {
    Router::get("/hello", function () {
      $name = $_REQUEST['name'];
      if ($name != null) {
        echo json_encode(array("greeting" => "Hello {$name}"));
      } else {
        echo json_encode(array("greeting" => "Hello"));
      }
    });
  }
}
