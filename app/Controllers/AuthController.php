<?php

class AuthController extends Controller
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        $database = new Database();
        $conexao = $database->conectar();

        $this->usuarioModel = new Usuario($conexao);
    }

    public function login(): void
    {
        if (isset($_SESSION['usuario'])) {
            header('Location: /meu-projeto-web/public/');
            exit;
        }

        $data = [
            'title' => 'Login | MentoriaGestor',
            'erro' => null
        ];

        $this->view('auth/login', $data);
    }

    public function autenticar(): void
    {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $this->view('auth/login', [
                'title' => 'Login | MentoriaGestor',
                'erro' => 'Informe o e-mail e a senha.'
            ]);

            return;
        }

        $usuario = $this->usuarioModel->buscarPorEmail($email);

        if (
            !$usuario ||
            $usuario['status'] !== 'ativo' ||
            !password_verify($senha, $usuario['senha'])
        ) {
            $this->view('auth/login', [
                'title' => 'Login | MentoriaGestor',
                'erro' => 'E-mail ou senha inválidos.'
            ]);

            return;
        }

        session_regenerate_id(true);

        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'perfil' => $usuario['perfil']
        ];

        header('Location: /meu-projeto-web/public/');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];

        session_destroy();

        header('Location: /meu-projeto-web/public/login');
        exit;
    }
}
