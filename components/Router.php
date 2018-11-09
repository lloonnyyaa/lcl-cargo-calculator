<?php

namespace app\components;

class Router {

    private $routes;

    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI() {
        $request_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');

        if (!empty($request_uri)) {
            return parse_url($request_uri, PHP_URL_PATH);
        }

        return false;
    }

    public function run() {
        if (!$uri = $this->getURI())
            return new \Exception('uri error');

        foreach ($this->routes as $route => $handler) {
            if (preg_match("~$route~", $uri, $matches)) {
                array_shift($matches);

                $data = empty($matches) ? [] : $matches;

                if (call_user_func_array([new $handler['class'], $handler['method']], $data) !== null) {
                    break;
                }
            }
        }
    }

}
