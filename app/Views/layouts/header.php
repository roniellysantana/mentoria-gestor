<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($title ?? 'MentoriaGestor') ?></title>

    <link
        rel="stylesheet"
        href="/meu-projeto-web/public/css/style.css"
    >
</head>
<body>

<header class="topo">
    <div class="container">
        <h1 class="logo">MentoriaGestor</h1>

        <nav class="menu">
            <a href="/meu-projeto-web/public/">Início</a>
            <a href="/meu-projeto-web/public/alunos">Alunos</a>
            <a href="/meu-projeto-web/public/concursos">Concursos</a>
            <a href="/meu-projeto-web/public/disciplinas">Disciplinas</a>
            <a href="/meu-projeto-web/public/relatorios">Relatórios</a>
        </nav>
    </div>
</header>

<main class="container">