<?php

spl_autoload_register(function(string $className){
    require(dirname(__DIR__).'\\'.$className.'.php');
});

    $route = isset($_GET['route']) ?  $_GET['route'] : '';
    $patterns = require('route.php');
    $findRoute = false;
    foreach($patterns as $pattern=>$controllerAndAction){
        if(preg_match($pattern, $route, $matches)){
            $findRoute = true;
            unset($matches[0]);
            $action = $controllerAndAction[1];
            $controller = new $controllerAndAction[0];
            $controller->$action(...$matches);
        }
    }

    if (!$findRoute) echo 'Страница не найдена';


