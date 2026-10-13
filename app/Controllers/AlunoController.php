<?php

class AlunoController extends Controller
{
    private Aluno $alunoModel;

    public function __construct()
    {
        Auth::exigirPerfil(['administrador', 'mentor']);

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
        $id = (int) ($_POST['id'] ?? 0);

        $alunoAtual = $this->alunoModel->buscarPorId($id);

        if (!$alunoAtual) {
            $this->redirecionar(
                'Aluno não encontrado.',
                'erro'
            );
        }

        $dados = [
            'id' => $id,
            'nome' => trim($_POST['nome'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'telefone' => trim($_POST['telefone'] ?? ''),
            'concurso_alvo' => trim($_POST['concurso_alvo'] ?? ''),
            'meta_semanal_sessoes' => (int) ($_POST['meta_semanal_sessoes'] ?? 0),
            'data_inicio' => $_POST['data_inicio'] ?? '',
            'plano' => $_POST['plano'] ?? '',
            'status' => $_POST['status'] ?? '',
            'edital_arquivo' => $alunoAtual['edital_arquivo'] ?? null,
            'plano_acao_arquivo' => $alunoAtual['plano_acao_arquivo'] ?? null
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

        if (empty($erros)) {
            $dados['edital_arquivo'] = $this->processarUpload(
                'edital',
                'edital',
                $dados['edital_arquivo'],
                $erros
            );

            $dados['plano_acao_arquivo'] = $this->processarUpload(
                'plano_acao',
                'plano_acao',
                $dados['plano_acao_arquivo'],
                $erros
            );
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

    private function processarUpload(
        string $campo,
        string $prefixo,
        ?string $arquivoAtual,
        array &$erros
    ): ?string {
        if (
            !isset($_FILES[$campo]) ||
            $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE
        ) {
            return $arquivoAtual;
        }

        $arquivo = $_FILES[$campo];

        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            $erros[] = 'Ocorreu um erro ao enviar o arquivo.';
            return $arquivoAtual;
        }

        $limite = 5 * 1024 * 1024;

        if ($arquivo['size'] > $limite) {
            $erros[] = 'O arquivo PDF deve ter no máximo 5 MB.';
            return $arquivoAtual;
        }

        $extensao = strtolower(
            pathinfo($arquivo['name'], PATHINFO_EXTENSION)
        );

        $tipoMime = mime_content_type($arquivo['tmp_name']);

        if (
            $extensao !== 'pdf' ||
            $tipoMime !== 'application/pdf'
        ) {
            $erros[] = 'Somente arquivos PDF são permitidos.';
            return $arquivoAtual;
        }

        $nomeArquivo = $prefixo . '_' . bin2hex(random_bytes(8)) . '.pdf';

        $pastaUploads = __DIR__ . '/../../public/uploads/';

        $destino = $pastaUploads . $nomeArquivo;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            $erros[] = 'Não foi possível salvar o arquivo enviado.';
            return $arquivoAtual;
        }

        return $nomeArquivo;
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
