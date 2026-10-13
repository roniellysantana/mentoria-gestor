<?php

class Usuario
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function buscarPorEmail(string $email): array|false
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch();
    }

    public function cadastrar(array $dados): bool
    {
        $sql = "
            INSERT INTO usuarios (
                nome,
                email,
                senha,
                perfil,
                status
            ) VALUES (
                :nome,
                :email,
                :senha,
                :perfil,
                :status
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->execute([
            ':nome' => $dados['nome'],
            ':email' => $dados['email'],
            ':senha' => $dados['senha'],
            ':perfil' => $dados['perfil'],
            ':status' => $dados['status']
        ]);
    }
}
