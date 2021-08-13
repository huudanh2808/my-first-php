<?php
require './vendor/autoload.php';

use Dotenv\Dotenv;
use Src\Core\Controller\SillyControllerInterface;
use Src\Core\Handler\SillyExceptionHandlerInterface;
use Src\Core\Handler\ExceptionHandler;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");

$dotenv = new Dotenv($_SERVER["DOCUMENT_ROOT"]);
$dotenv->load();


$res = get_declared_classes();
$autoloaderClassName = '';
foreach ($res as $className) {
    if (strpos($className, 'ComposerAutoloaderInit') === 0) {
        $autoloaderClassName = $className;
        break;
    }
}


$classLoader = $autoloaderClassName::getLoader();
$controllerDir = getenv('CONTROLLER_DIR');
$controllerDir = $controllerDir == null ? '/Controller/' : $controllerDir;

$controllerSuffix = getenv('CONTROLLER_SUFFIX');
$controllerSuffix = $controllerSuffix == null ? 'Controller' : $controllerSuffix;

$exceptionHandlerDir = getenv('HANDLER_DIR');
$exceptionHandlerDir = $exceptionHandlerDir == null ? '/Handler/' : $exceptionHandlerDir;

$exceptionHandlerSuffix = getenv('HANDLER_SUFFIX');
$exceptionHandlerSuffix = $exceptionHandlerSuffix == null ? 'ExceptionHandler' : $exceptionHandlerSuffix;
foreach ($classLoader->getClassMap() as $path) {
    // Load controller and handler files
    if ((str_contains($path, $controllerDir) && str_ends_with($path, "{$controllerSuffix}.php"))
        || (str_contains($path, $exceptionHandlerDir) && str_ends_with($path, "{$exceptionHandlerSuffix}.php"))) {
        require_once $path;
    }
}
// Get declared classes again
$res = get_declared_classes();

$handlers = array_filter($res, fn ($class) => is_subclass_of($class, SillyExceptionHandlerInterface::class));
foreach ($handlers as $handler) {
    $handler::register();
}

ExceptionHandler::bindHandler();

$controllers = array_filter($res, fn ($class) => is_subclass_of($class, SillyControllerInterface::class));
foreach ($controllers as $controller) {
    echo $controller;
    $controller::register();
}



