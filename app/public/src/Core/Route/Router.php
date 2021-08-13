<?php

namespace Src\Core\Route;

use Src\Core\Route\Route;
use Src\Core\Exception\RoutingException;
use Src\Core\Exception\RoutingNotFoundException;

class Router
{
    private static $ROUTE_MAP = [];

    public static function route($uri, $requestMethod, $callback)
    {
        $route = Route::with($uri, $requestMethod);
        if (!array_key_exists($route, self::$ROUTE_MAP)) {
            self::$ROUTE_MAP += array($route => $callback);
        } else {
            throw new RoutingException("Duplicated routing");
        }
    }

    public static function get($uri, $callback) {
        self::route($uri, RequestMethod::GET, $callback);
    }

    public static function post($uri, $callback) {
        self::route($uri, RequestMethod::POST, $callback);
    }

    public static function put($uri, $callback) {
        self::route($uri, RequestMethod::PUT, $callback);
    }

    public static function delete($uri, $callback) {
        self::route($uri, RequestMethod::DELETE, $callback);
    }

    public static function process($uri, $requestMethod)
    {
        $route = Route::with($uri, $requestMethod);
        if (array_key_exists($route, self::$ROUTE_MAP)) {
            $callback = self::$ROUTE_MAP[$route];
            if ($callback != null) {
                $callback();
            }
        } else {
            throw new RoutingNotFoundException("Not defined routing");
        }
    }

}
