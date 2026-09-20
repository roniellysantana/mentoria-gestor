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
            'alunos' => $alunos
        ];

        $this->view('alunos/index', $data);
    }

    public function criar(): void
    {
        $data = [
            'title' => 'Cadastrar aluno | MentoriaGestor'
        ];

        $this->view('alunos/criar', $data);
    }

    public function salvar(): void
    {
        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone'],
            'concurso_alvo' => $_POST['concurso_alvo'],
            'meta_semanal_sessoes' => $_POST['meta_semanal_sessoes'],
            'data_inicio' => $_POST['data_inicio'],
            'plano' => $_POST['plano'],
            'status' => 'ativo'
        ];

        $this->alunoModel->cadastrar($dados);

        header('Location: /meu-projeto-web/public/alunos');
        exit;
    }
}