<?php

namespace Controllers;

use Controller;

class Error extends Controller
{
    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function error400() {
        return "Error 400";
    }

    public function error405() {
        return 'Error 405!';
    }
}