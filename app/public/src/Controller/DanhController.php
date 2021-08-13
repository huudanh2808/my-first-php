<?php

namespace Src\Controller;

use Src\Core\Route\Router;
use Src\Core\Controller\SillyControllerInterface;

class DanhController implements SillyControllerInterface {
    
    public static function register()
    {
      
      Router::get("/danh", function () {
        $name = $_REQUEST['name'];
        if ($name != null) {
          echo json_encode(array("Danh" => "Hello {$name}"));
        } else {
          echo json_encode(array("Danh" => "CC"));
        }
      });

      Router::get("/danh2", function () {
        $name = $_REQUEST['name'];
        if ($name != null) {
          echo json_encode(array("Danh2" => "Hello {$name}"));
        } else {
          echo json_encode(array("Danh2" => "CC"));
        }
      });

    }
}