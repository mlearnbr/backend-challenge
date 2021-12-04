<?php

namespace App\Controllers;

use MF\Controller\Action;

class IndexController extends Action {

    

    public function index()
    {
        $this->view->dados = 'a' ;
        $this->render('index');
    }
    
    
}