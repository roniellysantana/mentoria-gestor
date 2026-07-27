# MentoriaGestor

Sistema de Gestão e Acompanhamento de Mentoria para Concursos.

## Sobre o projeto

O MentoriaGestor é uma aplicação web criada para centralizar o acompanhamento de alunos de mentoria para concursos públicos. O sistema permitirá gerenciar alunos, concursos-alvo, disciplinas, metas semanais de sessões, planos contratados e relatórios periódicos.

## Funcionalidades previstas

- Cadastro e gerenciamento de alunos;
- Cadastro de concursos e disciplinas;
- Associação de disciplinas aos alunos;
- Definição da meta semanal de sessões;
- Controle dos planos trimestral, semestral e anual;
- Cálculo automático da vigência da mentoria;
- Relatórios semanais dos alunos;
- Relatórios quinzenais do mentor;
- Upload e consulta de arquivos;
- Painel de acompanhamento;
- Autenticação e controle de acesso por perfil.

## Tecnologias

- PHP;
- Arquitetura MVC;
- MySQL ou PostgreSQL;
- PDO;
- HTML, CSS e JavaScript;
- Git e GitHub;
- XAMPP, WAMP ou Docker.

## Estrutura inicial

```text
meu-projeto-web/
├── app/
├── config/
├── core/
├── public/
└── README.md
```

## Entrega Parcial 2

Nesta etapa foi implementada a base arquitetural da aplicação MentoriaGestor.

### Funcionalidades implementadas

- Estrutura MVC;
- Controller-base para carregamento das views;
- Sistema de rotas;
- Página inicial da aplicação;
- Controllers iniciais de alunos, concursos, disciplinas e relatórios;
- Views iniciais compartilhando cabeçalho e rodapé;
- Rotas para alunos, concursos, disciplinas e relatórios;
- Tratamento de rota inexistente com erro 404;
- Interface web responsiva;
- Redirecionamento de URLs por meio do arquivo `.htaccess`.

### Rotas implementadas

```text
/              Página inicial
/alunos        Gestão inicial de alunos
/concursos     Gestão inicial de concursos
/disciplinas   Gestão inicial de disciplinas
/relatorios    Gestão inicial de relatórios

Execução local
1. Instalar e iniciar o Apache pelo XAMPP;
2. Colocar a pasta do projeto dentro de C:\xampp\htdocs;
3. Acessar no navegador:
```text
http://localhost/meu-projeto-web/public/
```
## Autor

Ronielly Santana

## Disciplina

Projeto e Implementação de Sistemas para Web II  
Professor: Pedro Henrique Neves da Silva  
UNIVASF - Análise e Desenvolvimento de Sistemas  
Petrolina - PE, 2026
