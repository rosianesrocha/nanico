<?php

namespace Controllers;

use Core;

class HomeController extends ApplicationController
{
        public function index()
        {
                $this->view('home/index');       
        }
}
