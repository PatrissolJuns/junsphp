<?php

namespace Controllers;

use View;
use Controller;

class HomeController extends Controller
{
    public function index()
    {
        return View::render('home');
    }
}
