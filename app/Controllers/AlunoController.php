<?php

class AlunoController extends Controller
{
    private Aluno $alunoModel;

    public function __construct()
    {
        $database = new Database();
        $conexao = $database->conectar();

        $this->alunoModel = new Aluno($conexao);
    }

    public function index(): void
    {
        $alunos = $this->alunoModel->listarTodos();

        $data = [
            'title' => 'Alunos | MentoriaGestor',
            'alunos' => $alunos,
            'mensagem' => $_GET['mensagem'] ?? null,
            'tipo' => $_GET['tipo'] ?? null
        ];

        $this->view('alunos/index', $data);
    }

    public function criar(): void
    {
        $data = [
            'title' => 'Cadastrar aluno | MentoriaGestor',
            'erros' => [],
            'dados' => []
        ];

        $this->view('alunos/criar', $data);
    }

    public function salvar(): void
    {
        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'telefone' => trim($_POST['telefone'] ?? ''),
            'concurso_alvo' => trim($_POST['concurso_alvo'] ?? ''),
            'meta_semanal_sessoes' => (int) ($_POST['meta_semanal_sessoes'] ?? 0),
            'data_inicio' => $_POST['data_inicio'] ?? '',
            'plano' => $_POST['plano'] ?? '',
            'status' => 'ativo'
        ];

        $erros = $this->validarDados($dados);

        if ($dados['email'] !== '' && $this->alunoModel->emailExiste($dados['email'])) {
            $erros[] = 'Já existe um aluno cadastrado com este e-mail.';
        }

        if (!empty($erros)) {
            $this->view('alunos/criar', [
                'title' => 'Cadastrar aluno | MentoriaGestor',
                'erros' => $erros,
                'dados' => $dados
            ]);

            return;
        }

        try {
            $this->alunoModel->cadastrar($dados);

            $this->redirecionar(
                'Aluno cadastrado com sucesso.',
                'sucesso'
            );
        } catch (PDOException $e) {
            $this->redirecionar(
                'Não foi possível cadastrar o aluno.',
                'erro'
            );
        }
    }

    public function editar(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $aluno = $this->alunoModel->buscarPorId($id);

        if (!$aluno) {
            $this->redirecionar(
                'Aluno não encontrado.',
                'erro'
            );
        }

        $data = [
            'title' => 'Editar aluno | MentoriaGestor',
            'aluno' => $aluno,
            'erros' => []
        ];

        $this->view('alunos/editar', $data);
    }

    public function atualizar(): void
    {
        $dados = [
            'id' => (int) ($_POST['id'] ?? 0),
            'nome' => trim($_POST['nome'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'telefone' => trim($_POST['telefone'] ?? ''),
            'concurso_alvo' => trim($_POST['concurso_alvo'] ?? ''),
            'meta_semanal_sessoes' => (int) ($_POST['meta_semanal_sessoes'] ?? 0),
            'data_inicio' => $_POST['data_inicio'] ?? '',
            'plano' => $_POST['plano'] ?? '',
            'status' => $_POST['status'] ?? ''
        ];

        $erros = $this->validarDados($dados);

        if ($dados['id'] <= 0) {
            $erros[] = 'Aluno inválido.';
        }

        if (
            $dados['email'] !== '' &&
            $this->alunoModel->emailExiste($dados['email'], $dados['id'])
        ) {
            $erros[] = 'Já existe outro aluno cadastrado com este e-mail.';
        }

        if (!empty($erros)) {
            $this->view('alunos/editar', [
                'title' => 'Editar aluno | MentoriaGestor',
                'aluno' => $dados,
                'erros' => $erros
            ]);

            return;
        }

        try {
            $this->alunoModel->atualizar($dados);

            $this->redirecionar(
                'Aluno atualizado com sucesso.',
                'sucesso'
            );
        } catch (PDOException $e) {
            $this->redirecionar(
                'Não foi possível atualizar o aluno.',
                'erro'
            );
        }
    }

    public function excluir(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0 || !$this->alunoModel->buscarPorId($id)) {
            $this->redirecionar(
                'Aluno não encontrado.',
                'erro'
            );
        }

        try {
            $this->alunoModel->excluir($id);

            $this->redirecionar(
                'Aluno excluído com sucesso.',
                'sucesso'
            );
        } catch (PDOException $e) {
            $this->redirecionar(
                'Não foi possível excluir o aluno.',
                'erro'
            );
        }
    }

    private function validarDados(array $dados): array
    {
        $erros = [];

        if ($dados['nome'] === '') {
            $erros[] = 'O nome é obrigatório.';
        }

        if ($dados['email'] === '') {
            $erros[] = 'O e-mail é obrigatório.';
        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Informe um e-mail válido.';
        }

        if ($dados['concurso_alvo'] === '') {
            $erros[] = 'O concurso-alvo é obrigatório.';
        }

        if ($dados['meta_semanal_sessoes'] < 1) {
            $erros[] = 'A meta semanal deve ser de pelo menos 1 sessão.';
        }

        if ($dados['data_inicio'] === '') {
            $erros[] = 'A data de início é obrigatória.';
        }

        if (!in_array(
            $dados['plano'],
            ['trimestral', 'semestral', 'anual'],
            true
        )) {
            $erros[] = 'Selecione um plano válido.';
        }

        if (
            isset($dados['status']) &&
            !in_array($dados['status'], ['ativo', 'inativo'], true)
        ) {
            $erros[] = 'Selecione uma situação válida.';
        }

        return $erros;
    }

    private function redirecionar(string $mensagem, string $tipo): void
    {
        $parametros = http_build_query([
            'tipo' => $tipo,
            'mensagem' => $mensagem
        ]);

        header(
            'Location: /meu-projeto-web/public/alunos?' . $parametros
        );

        exit;
    }
}
