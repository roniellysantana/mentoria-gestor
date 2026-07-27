<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo '<h1>Erro interno</h1>';
            echo '<p>A view solicitada não foi encontrada.</p>';
            return;
        }

        require __DIR__ . '/../app/Views/layouts/header.php';
        require $viewPath;
        require __DIR__ . '/../app/Views/layouts/footer.php';
    }
}