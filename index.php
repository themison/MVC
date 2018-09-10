<?php   
spl_autoload_register(function($class) {
    require_once __DIR__.'/'.$class.'.php';
});


$route = $_GET['route'] ?? '';
$routes = require __DIR__.'/routes/routes.php';

$routeFound = true;

foreach ($routes as $regular => $controllerAndAction) {
    preg_match($regular,$route,$mathes);
    if(!empty($mathes)) {
        $routeFound = false;
        break;
    }

};

if($routeFound) {
    $error = new Controllers\MainController;
    $error->emptyPage();
    return;
}

unset($mathes[0]);

$controller = $controllerAndAction[0];
$action = $controllerAndAction[1];


$className = new $controller();
$className->$action(...$mathes);




    

