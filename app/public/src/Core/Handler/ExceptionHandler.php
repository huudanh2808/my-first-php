<?php

namespace Src\Core\Handler;

class ExceptionHandler
{
    private static $HANDLER_MAP = [];

    public static function register($exception, $callback)
    {
        if ($exception != null && is_subclass_of($exception, \Exception::class)) {
            if (array_key_exists($exception, self::$HANDLER_MAP)) {
                self::$HANDLER_MAP[$exception] += array($callback);
            } else {
                self::$HANDLER_MAP += array($exception => array($callback));
            }
        }
    }

    public static function bindHandler()
    {
        set_exception_handler(function ($exception) {
            $exceptionClassName = get_class($exception);
            if (array_key_exists($exceptionClassName, self::$HANDLER_MAP)) {
                foreach (self::$HANDLER_MAP[$exceptionClassName] as $callback) {
                    $callback($exception);
                }
            }
        });
    }
}
