<?php

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function dispatch(string $requestMethod, string $requestUri): void
    {
        $path = parse_url($requestUri, PHP_URL_PATH);

        $basePath = '/meu-projeto-web/public';

        if (str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
        }

        if ($path === '') {
            $path = '/';
        }

        $handler = $this->routes[$requestMethod][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo '<h1>Erro 404</h1>';
            echo '<p>Página não encontrada.</p>';
            return;
        }

        [$controllerClass, $method] = $handler;

        $controller = new $controllerClass();
        $controller->$method();
    }
}