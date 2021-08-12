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
    public Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @return false|mixed|string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return "Not found";
        }
        if (is_string($callback)){
            $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    /**
     * @param $view
     * @return array|false|string|string[]
     */
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @return false|string
     */
    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}