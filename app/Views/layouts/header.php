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

        <?php if (isset($_SESSION['usuario'])): ?>

            <nav class="menu">
                <a href="/meu-projeto-web/public/">Início</a>

                <?php if (in_array($_SESSION['usuario']['perfil'], ['administrador', 'mentor'], true)): ?>
                    <a href="/meu-projeto-web/public/alunos">Alunos</a>
                <?php endif; ?>

                <a href="/meu-projeto-web/public/concursos">Concursos</a>
                <a href="/meu-projeto-web/public/disciplinas">Disciplinas</a>
                <a href="/meu-projeto-web/public/relatorios">Relatórios</a>

                <span class="usuario-logado">
                    <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>
                    (<?= htmlspecialchars(ucfirst($_SESSION['usuario']['perfil'])) ?>)
                </span>

                <a
                    class="link-sair"
                    href="/meu-projeto-web/public/logout"
                >
                    Sair
                </a>
            </nav>

        <?php endif; ?>
    </div>
</header>

<main class="container">
