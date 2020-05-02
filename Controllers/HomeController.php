<?php

namespace Controllers;

use Core\View;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return View::render('home');
    }
}
