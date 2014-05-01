<?php

namespace Suggestotron;


class Router {

    public function start($route) {
        if ($route{0} == "/") {
            $route = substr($route, 1);
        }

        $controller = new \Suggestotron\Controller\Topics();

        $method = [$controller, $route . "Action"];

        if(is_callable($method)) {
            return $method();
        }

        require 'error.php';
    }

} 