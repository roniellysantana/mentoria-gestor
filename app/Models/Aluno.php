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
}