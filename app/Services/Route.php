<?php
 namespace App\Services;

 class Route{
    private static $routes = [];
    private static $controllerNamespace = 'App\Controllers\\';

    private static function normalizePath($path)
    {
        $path = parse_url($path, PHP_URL_PATH) ?: '/';

        return trim($path, '/');
    }

    public static function add($uri,$controller,$action,$method='GET',$middleware=[]){
        self::$routes[]=[
            'uri'=>$uri,
            'controller'=>$controller,
            'action'=>$action,
            'method'=>strtoupper($method),
            'middleware'=>$middleware
];
        
 }
    public static function handle (){
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $requestPath = self::normalizePath($requestUri);
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

        foreach (self::$routes as $route) {
            if (self::normalizePath($route['uri']) === $requestPath && $route['method'] === $requestMethod) {
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