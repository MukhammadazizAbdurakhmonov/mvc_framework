<?php 
/**
 * index file is entry file for application 
 * Any incoming request will be handled first here
 */
require_once "../vendor/autoload.php";
require_once "../routes/web.php";

use Src\Core\Dispatcher;

$dispatcher = new Dispatcher($router);
$dispatcher->handle();