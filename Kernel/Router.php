<?php

namespace Kernel;

/**
 * This class is responsible of the routing of the app.
 * It means that the only valable route are in this class.
 * Any other one would throw an error
 */
class Router
{
    /**
     * Contain the differents routes and theirs method and controller
     */
    private static $RoutingTable = [];
    
    /**
     * This function create a new route
     * 
     * @param string $method This is the method to use GET|POST|PUT|DELETE
     * @param string $uri This is the uri to add
     * @param string $controller This is the controller which will be handle the incoming request on this route  
     */
    private static function addRoute($method, $uri, $controller)
    {
        $route = array(
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        );
        array_push(self::$RoutingTable, $route);
    }

    /**
     * Register a new GET route.
     *
     * @param  string  $uri
     * @param  string  $controller
     */
    public static function get($uri, $controller)
    {
        self::addRoute('GET', $uri, $controller);
    }

    /**
     * Register a new POST route.
     *
     * @param  string  $uri
     * @param  string  $controller
     */
    public static function post($uri, $controller)
    {
        self::addRoute('POST', $uri, $controller);
    }

    /**
     * Register a new PUT route.
     *
     * @param  string  $uri
     * @param  string  $controller
     */
    public static function put($uri, $controller)
    {
        self::addRoute('PUT', $uri, $controller);
    }

    /**
     * Register a new DELETE route.
     *
     * @param  string  $uri
     * @param  string  $controller
     */
    public static function delete($uri, $controller)
    {
        self::addRoute('DELETE', $uri, $controller);
    }

    /**
     * This function is the heard of the routing of the app.
     * For request receiving in parameter, it will set the controller,
     * the action, the params according to the RoutingTable
     * 
     * @param \Kernel\Request $request 
     */
    
    public static function parse($request)
    {
        // Remove whitespace from the uri 
        $url = trim($request->getUrl());

        // retrieve the url in a array
        $explode_url = explode('/', $url, 3);
        /* echo " explode_url = "; print_r($explode_url);
        echo " url = ".$url."\n"; */
        $index = array_search("/".$explode_url[2], array_column(self::$RoutingTable, 'uri'));
        // echo "index = ".$index;

        // If the route is not found in the RoutingTable then return the 400 Error
        if($index === false){
            $request->setController('error');
            $request->setAction("error400");
        } 
        else {
            $routeItem = self::$RoutingTable[$index];

            // If the method is not the one in the RoutingTable table, return a 405 Error 
            if($routeItem['method'] != $request->getMethod()){
                $request->setController('error');
                $request->setAction("error405");
            }

            // Everything went fine
            else {
                $FullController = explode('@', $routeItem['controller']);
                $request->setController($FullController[0]);
                $request->setAction($FullController[1]);
            }
        }
    }
}
?>