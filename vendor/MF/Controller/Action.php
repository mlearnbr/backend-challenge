<?php

namespace MF\Controller;

abstract class Action
{
    
    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    protected function render($view)
    {
        $this->view->page = $view;
        require_once "../App/Views/layout.phtml";
    }

    protected function content(){
        $classAtual = get_class($this);
        $classAtual = str_replace("App\\Controllers\\",'',$classAtual);
        $classAtual = strtolower(str_replace("Controller",'',$classAtual));
        require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";
    }

}


