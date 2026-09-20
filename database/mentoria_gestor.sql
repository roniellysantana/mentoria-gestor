CREATE DATABASE IF NOT EXISTS mentoria_gestor
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mentoria_gestor;

CREATE TABLE IF NOT EXISTS alunos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    concurso_alvo VARCHAR(150) NOT NULL,
    meta_semanal_sessoes INT UNSIGNED NOT NULL,
    data_inicio DATE NOT NULL,
    plano ENUM('trimestral', 'semestral', 'anual') NOT NULL,
    status ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);