<?php 

namespace Src\Core;

/**
 * Matching incoming urls to registered routes
 */
class Router
{
    /**
     * Stores routes
     * @var array
     */
    public $routes = [];

    /**
     * Stores matched route
     * @var array
     */
    public $matched_route =[];
    
    /**
     * Getting incoming url, filter it and return filtered url array
     * Url is returned as array
     * Example, https://localhost/mvc_framework/routing url is returned as ['localhost', 'mvc_framework', 'routing']
     * @return array
     */
    public function getUrl(): array
    {
            $incoming_url = ($_SERVER['REQUEST_URI']);
            $incoming_url = parse_url($incoming_url, PHP_URL_PATH);
            $incoming_url = trim($incoming_url, "/");
            $incoming_url = array_values(array_filter((explode('/', $incoming_url))));
            return $incoming_url;
    }

    /**
     * Add routes to routes array
     * @param string $url
     * @param array $params
     * @return array
     */
    public function add(string $url, array $params): array
    {
        return $this->routes[] = [
            'url' => $url,
            'params' => [
                'controller' => $params[0],
                'method' => $params[1]
            ]
        ];
    }

    /**
     * Matching route for incoming url 
     * Url elements and route elements are convereted to array and will be compared 
     * if they are matched exactly, return matched route if not false
     * @return array|bool
     */
    public function matchRoute()
    {
        foreach($this->routes as $route){

            $trimmed_route = trim($route['url'], '/'); /**Remove / character from beginning and ending */
            $route_parts_into_array = explode('/', $trimmed_route); /** Breaks route string into array, explode where there is / character */
            $get_route_parameters = preg_grep('/{(.*?)}/', $route_parts_into_array); /** Return array of elements between { } brackets */
            $difference_of_url_and_route = array_diff($this->getUrl(), $route_parts_into_array); /**Difference between url and route */
            $difference_of_url_and_route_keys = array_diff_key($difference_of_url_and_route, $get_route_parameters);

            if(count($this->getUrl()) == count($route_parts_into_array) and count($difference_of_url_and_route_keys) == 0){
                return $this->matched_route = [
                        'controller' => $route['params']['controller'],
                        'method' => $route['params']['method'],
                        'arguments' => $difference_of_url_and_route,
                ];
            }
        }
        return false;
    }
}
