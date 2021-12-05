<?php

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap {

    

    public function initRoutes(){
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index',
        );
        $routes['usuario'] = array(
            'route' => '/usuario',
            'controller' => 'indexController',
            'action' => 'usuario',
        );
        $routes['usuarios'] = array(
            'route' => '/usuarios',
            'controller' => 'indexController',
            'action' => 'usuarios',
        );
        $routes['usuarioInsert'] = array(
            'route' => '/usuarioInsert',
            'controller' => 'indexController',
            'action' => 'usuarioInsert',
        );
        $routes['usuarioTrocaLevel'] = array(
            'route' => '/usuarioTrocaLevel',
            'controller' => 'indexController',
            'action' => 'usuarioTrocaLevel',
        );
        
        $this->setRoutes($routes);
    }

    
}
