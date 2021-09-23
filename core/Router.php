<?php

namespace Core;

use App\Controllers\Errors;

class Router
{
    /**
     * Added routes collection
     *
     * @var array
     */
    private array $routes = [];

    /**
     * Allowed HTTP methods
     *
     * @var array|string[]
     */
    private array $allowedMethods = ['GET', 'POST'];

    /**
     * Add rout to collection
     *
     * @param string $method HTTP method
     * @param string $path '/test/(\w+)/(\d+)' -> '/test/name/123'
     * @param string $handler 'Test/Home::foo' -> App\Controllers\Test\Home::foo('name', 123)
     * @return $this
     */
    public function add(string $method, string $path, string $handler)
    {
        if (!in_array($method, $this->allowedMethods)) {
            die("Error! Method '$method' is not allowed.");
        }

        $parsePath = $this->parsePath($path);
        $this->routes[$method][$parsePath['path']] = [
            'path' => $path,
            'handler' => $handler,
            'args' => $parsePath['args'],
        ];

        return $this;
    }

    /**
     * Search and run rout for real uri string
     *
     * @return mixed
     */
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            $path = $route['path'];
            if (preg_match("|^$path/?$|", URI_PATH)) {
                return $this->runHandler($route['handler'], ...$route['args']);
            }
        }

        (new Errors)->error404();
    }

    /**
     * Parse $path from $this->add() method
     * and real uri string
     *
     * @param string $path '/test/(\w+)/(\d+)' -> '/test/name/123'
     * @return array ['path' => '/test/', 'args' => [0 => [1 => 'name', 2 => 123]]]
     */
    private function parsePath(string $path): array
    {
        $argsStr = strstr($path, '(');
        $result['path'] = strstr($path, '(', true) ?: $path;
        $result['args'] = [];

        if ($argsStr) {
            preg_match_all("|^$path/?$|", URI_PATH, $args, PREG_SET_ORDER);
            unset($args[0][0]);
            $result['args'] = $args;
        }

        return $result;
    }

    /**
     * Parse handler and run controller method with args
     * if existed.
     *
     * @param string $handler 'Test/Home::foo'
     * @param array $args [0 => [1 => 'name', 2 => 123]]
     * @return mixed App\Controllers\Test\Home::foo('name', 123)
     */
    private function runHandler(string $handler, array $args = [])
    {
        $exp = explode('::', str_replace(' ', '', $handler));
        $controllerPath = $exp[0];
        $method = $exp[1] ?? null;

        if (file_exists(APP_PATH . 'Controllers/' . $controllerPath . '.php')) {
            $namespace = 'App\Controllers\\' . str_replace('\\', '/', $controllerPath);
            $handler = new $namespace;

            if (!$method) {
                return $handler->index(...$args);
            } elseif (!method_exists($handler, $method)) {
                die("Error! Not found method '$method' in controller '$controllerPath'.");
            }

            $handler->$method(...$args);
        } else {
            die("Error! Not found controller '$controllerPath'.");
        }
    }
}