<?php
 namespace App\Services;

 class Route{
    private static $routes = [];
    private static $controllerNamespace = 'App\Controllers\\';

    public static function add($uri,$controller,$action,$method='GET',$middleware=[]){
        self::$routes[]=[
            'uri'=>$uri,
            'controller'=>$controller,
            'action'=>$action,
            'method'=>$method,
            'middleware'=>$middleware
];
        
 }

    public static function handle (){
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                $controllerClass = self::$controllerNamespace . $route['controller'];
                $action = $route['action'];

                $controller = new $controllerClass();
                $controller->$action();
                return;
            }
        }

        // No matching route found
        http_response_code(404);
        echo '404 error page found';
    }

}