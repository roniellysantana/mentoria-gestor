<?php

class Aluno
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function listarTodos(): array
    {
        $sql = "
            SELECT *
            FROM alunos
            ORDER BY nome ASC
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): array|false
    {
        $sql = "
            SELECT *
            FROM alunos
            WHERE id = :id
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }

    public function cadastrar(array $dados): bool
    {
        $sql = "
            INSERT INTO alunos (
                nome,
                email,
                telefone,
                concurso_alvo,
                meta_semanal_sessoes,
                data_inicio,
                plano,
                status
            ) VALUES (
                :nome,
                :email,
                :telefone,
                :concurso_alvo,
                :meta_semanal_sessoes,
                :data_inicio,
                :plano,
                :status
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':concurso_alvo' => $dados['concurso_alvo'],
            ':meta_semanal_sessoes' => $dados['meta_semanal_sessoes'],
            ':data_inicio' => $dados['data_inicio'],
            ':plano' => $dados['plano'],
            ':status' => $dados['status']
        ]);
    }

    public function atualizar(array $dados): bool
    {
        $sql = "
            UPDATE alunos
            SET
                nome = :nome,
                email = :email,
                telefone = :telefone,
                concurso_alvo = :concurso_alvo,
                meta_semanal_sessoes = :meta_semanal_sessoes,
                data_inicio = :data_inicio,
                plano = :plano,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':id' => $dados['id'],
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':concurso_alvo' => $dados['concurso_alvo'],
            ':meta_semanal_sessoes' => $dados['meta_semanal_sessoes'],
            ':data_inicio' => $dados['data_inicio'],
            ':plano' => $dados['plano'],
            ':status' => $dados['status']
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "
            DELETE FROM alunos
            WHERE id = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function emailExiste(string $email, ?int $ignorarId = null): bool
    {
        $sql = "
            SELECT COUNT(*)
            FROM alunos
            WHERE email = :email
        ";

        if ($ignorarId !== null) {
            $sql .= " AND id != :id";
        }

        $stmt = $this->conexao->prepare($sql);

        $parametros = [
            ':email' => $email
        ];

        if ($ignorarId !== null) {
            $parametros[':id'] = $ignorarId;
        }

        $stmt->execute($parametros);

        return $stmt->fetchColumn() > 0;
    }
}
