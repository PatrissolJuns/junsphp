<?php
namespace Kernel;
use Kernel\Request;

/**
 * Principal class of the framework
 * It functions is to dispatche a request to the correspondent controller
 */
class Dispatcher
{

    private $request;

    /**
     * Principal function of the app as a whole
     * It functions is to receive a request and dispatche it to the correspondent controller
     */
    public function dispatch()
    {
        $this->request = new Request();
        
        // Setting the different element of the request
        Router::parse($this->request); 

        // Load the appropiate controller
        $controller = $this->loadController($this->request);

        // Run the controller
        echo call_user_func_array([$controller, $this->request->getAction()], $this->request->getParams());
    }

    /**
     * Load a controller according to a request
     * 
     * @return Controller
     */
    public function loadController($request)
    {
        // Get the correspondent controller
        $name = $this->request->getController();

        // Collecting the controller's file
        $file = ROOT . 'Controllers/' . $name . '.php'; 

        // Insertion of the class controller
        require($file);  

        // Instanciation of the controller
        $controller = new $name($request);

        // Finally return that controller
        return $controller; 
    }

}
?>