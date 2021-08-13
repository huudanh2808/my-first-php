<?php

namespace Src\Core\Route;

class Route
{
    const SEPARTOR = " ";

    public static function with($uri, $requestMethod)
    {
        return $uri . self::SEPARTOR . $requestMethod;
    }
  
}
