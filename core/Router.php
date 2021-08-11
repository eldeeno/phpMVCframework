<?php
/**
 * @User:   Eldeeno
 * Date:    11/08/2021
 * Time:    9:15 PM
 */

namespace app\core;

class Router
{
    public Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return "Not found";
        }

        if (is_string($callback)){
            $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        include_once __DIR__ . "/../views/$view.php";
    }

}