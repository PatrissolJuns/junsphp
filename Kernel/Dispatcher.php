<?php

namespace Kernel;
use Core\Controller;
use Kernel\Request;

/**
 * Principal class of the framework
 * It functions is to dispatch a request to the correspondent controller
 */
class Dispatcher
{

    private $request;
    private $controllerNamespaces = 'Controllers';

    /**
     * Principal function of the app as a whole
     * It functions is to receive a request and dispatch it to the correspondent controller
     */
    public function dispatch()
    {
        $this->request = new Request();
        
        // Setting the different element of the request
        Router::parse($this->request); 

        // Load the appropriate controller
        $controller = $this->loadController($this->request);

        // Run the controller
        echo call_user_func_array([$controller, $this->request->getAction()], $this->request->getParams());
    }

    /**
     * Load a controller according to a request
     *
     * @param \Kernel\Request $request
     * @return Controller
     */
    public function loadController(Request $request)
    {
        // Get the correspondent controller
        $name = $this->request->getController();

        // Collecting the controller's file
        $file = ROOT . 'Controllers/' . $name . '.php';

        // Insertion of the class controller
        require($file);

        // Taking care of namespaces
        $classNameWithNamespaces = $this->controllerNamespaces . "\\" . $name;

        // Instantiation of the controller
        $controller = new $classNameWithNamespaces($request);

        // Finally return that controller
        return $controller; 
    }

}
