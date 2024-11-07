<?php 

namespace Src\Core;

use ReflectionClass;

/**
 * Responsible for handling incoming routes
 */
class Dispatcher
{
    public function __construct(private Router $router)
    {

    }

    /**
     * If incoming route is matched then divide into controller, method and parametres if not simple returns 404 not found message
     * @return void
     */
    public function handle()
    {
        if($this->router->matchRoute() != false){

            $controller= $this->router->matched_route['controller'];
            $controller_object = $this->getObject($controller);

            $method = $this->router->matched_route['method'];
            
            $arguments = $this->router->matched_route['arguments'];
            call_user_func_array([$controller_object, $method], $arguments);
        }else{
            http_response_code(404);
            die();
        }
    }

    /**
     * Returns controller object with its dependencies
     * Creates class object after matching controller
     * 
     * @param string $class_name
     * @return object
     */
    private function getObject(string $class_name)
    {
        $reflector = new ReflectionClass($class_name);
        $constructor = $reflector->getConstructor();
        $dependencies = [];

        if($constructor === null){

            return new $class_name;
        };

        foreach($constructor->getParameters() as $parameter){

            $type = (string) $parameter->getType();
            $dependencies[] = $this->getObject($type);

        }

        return  new $class_name(...$dependencies);
    }
}
