<?php

class Auth
{
    public static function autenticado(): bool
    {
        return isset($_SESSION['usuario']);
    }

    public static function usuario(): ?array
    {
        return $_SESSION['usuario'] ?? null;
    }

    public static function exigirLogin(): void
    {
        if (!self::autenticado()) {
            header('Location: /meu-projeto-web/public/login');
            exit;
        }
    }

    public static function exigirPerfil(array $perfisPermitidos): void
    {
        self::exigirLogin();

        $perfil = $_SESSION['usuario']['perfil'] ?? '';

        if (!in_array($perfil, $perfisPermitidos, true)) {
            http_response_code(403);

            $title = 'Acesso negado | MentoriaGestor';

            require __DIR__ . '/../app/Views/layouts/header.php';
            require __DIR__ . '/../app/Views/auth/acesso-negado.php';
            require __DIR__ . '/../app/Views/layouts/footer.php';

            exit;
        }
    }
}
