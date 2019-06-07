<?php

    namespace Kernel;

    /**
     * THis class represent a request a any moment
     */
    class Request
    {
        private $url;
        private $method;
        private $params;
        private $cookies;
        private $controller;
        private $action;

        public function __construct()
        {
            $this->url = $_SERVER["REQUEST_URI"];
            $this->method = $_SERVER["REQUEST_METHOD"];
            $this->params = $_POST;
            $this->cookies = $_COOKIE;
            $this->controller = '';
            $this->action = '';
        }

        public function getUrl()
        {
            return $this->url;
        }
        public function getMethod()
        {
            return $this->method;
        }
        public function getParams()
        {
            return $this->params;
        }
        public function getCookies()
        {
            return $this->cookies;
        }
        public function getController()
        {
            return $this->controller;
        }
        public function getAction()
        {
            return $this->action;
        }

        public function setController($controller)
        {
            if($controller != '') $this->controller = $controller;
        }
        public function setAction($action)
        {
            if($action != '') $this->action = $action;
        }
        
    }

?>