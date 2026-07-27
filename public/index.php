<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AlunoController.php';
require_once __DIR__ . '/../app/Controllers/ConcursoController.php';
require_once __DIR__ . '/../app/Controllers/DisciplinaController.php';
require_once __DIR__ . '/../app/Controllers/RelatorioController.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/alunos', [AlunoController::class, 'index']);
$router->get('/concursos', [ConcursoController::class, 'index']);
$router->get('/disciplinas', [DisciplinaController::class, 'index']);
$router->get('/relatorios', [RelatorioController::class, 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);