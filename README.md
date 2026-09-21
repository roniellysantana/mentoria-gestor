# 🚀 Projeto Integrador – Disciplina: Projeto e Implementação de Sistemas para Web II

Bem-vindos ao repositório base do Projeto Integrador! Este documento reúne todas as diretrizes, requisitos mínimos, cronograma de entregas e critérios de avaliação necessários para o desenvolvimento do projeto ao longo do semestre.

---

## 📅 Apresentação e Dinâmica de Trabalho
O objetivo do Projeto Integrador é proporcionar uma experiência prática de desenvolvimento de aplicações web completas e funcionais, aplicando de forma incremental os conhecimentos adquiridos na disciplina.

* **Formação de Equipes:** O projeto deve ser desenvolvido em duplas (ou individualmente, conforme autorização), definidas nas semanas iniciais.
* **Desenvolvimento Incremental:** O sistema será construído gradualmente. Cada entrega parcial servirá como base direta para a etapa seguinte.
* **Temas Livres:** As equipes têm liberdade para escolher o escopo do sistema (Ex: Controle de Estoque, Gestão Escolar, Clínicas, Eventos, Finanças), desde que validado previamente com o professor.

---

## 🛠️ Tecnologias Obrigatórias
Para a construção do ecossistema de software, todas as equipes deverão utilizar estritamente o seguinte *tech stack*:

* **Backend:** PHP (Orientado a Objetos).
* **Arquitetura:** MVC (*Model-View-Controller*).
* **Banco de Dados:** PostgreSQL ou MySQL.
* **Controle de Versão:** Git & GitHub.
* **Ambiente Local:** Docker, XAMPP ou WampServer.

---

## 📋 Requisitos Mínimos do Sistema
Independentemente do tema escolhido, a versão final da aplicação deverá conter:

- [x] Arquitetura MVC devidamente isolada e estruturada.
- [x] Mecanismo de persistência conectado via PDO a um Banco de Dados Relacional.
- [x] Sistema próprio de gerenciamento de Rotas amigáveis.
- [x] Operações CRUD completas para a entidade principal do escopo.
- [x] Validações básicas de formulários.
- [ ] Sistema de Autenticação completo (*Login* e *Logout*).
- [ ] Controle de Sessões ativo e persistência de estado segura.
- [ ] Controle de acesso baseado em Perfis (Mínimo: *Administrador* e *Usuário Comum*).
- [ ] Funcionalidade de manipulação e *upload* de arquivos.
- [ ] Mecanismos adicionais de tratamento de erros, exceções e segurança de dados.
- [x] Interface web funcional.
- [ ] *Deploy* da aplicação realizado em servidor ou ambiente de nuvem público.

---

## ⏱️ Cronograma e Pontuação das Entregas

| Etapa | Foco da Entrega | Prazo Estimado |
| :--- | :--- | :--- |
| **Entrega Parcial 1** | Planejamento, Modelagem (MER/DER) e Protótipos | Semana 3 |
| **Entrega Parcial 2** | Estrutura MVC Inicial e Sistema de Rotas | Semana 5 |
| **Entrega Parcial 3** | Conexão de Banco de Dados (PDO) e CRUD Inicial (C e R) | Semana 7 |
| **Entrega Parcial 4** | CRUD Completo da Entidade (C, R, U, D) e Validações | Semana 9 |
| **Entrega Parcial 5** | Sessões, Autenticação de Usuários e Níveis de Acesso | Semana 12 |
| **Projeto Final** | Sistema Completo, Documentação (*Manual*) e Vídeo de Demonstração | Semana 16 |

---

## ⚖️ Critérios Gerais de Avaliação

A nota final do ecossistema de software desenvolvido considerará a seguinte distribuição de pesos técnicos:

* **Funcionalidade da Aplicação (40%):** O sistema cumpre o escopo proposto sem falhas técnicas ou bugs impeditivos?
* **Arquitetura MVC (20%):** Há separação estrita de responsabilidades entre as camadas de controle, dados e visualização?
* **Banco de Dados (15%):** A modelagem física atende à terceira forma normal? As consultas via PDO utilizam boas práticas contra injeção de código?
* **Segurança (10%):** Senhas estão devidamente hasheadas? Rotas sensíveis estão protegidas contra acessos não autenticados?
* **Interface e Usabilidade (5%):** A experiência do usuário é fluida, clara e com tratamento visual agradável?
* **Documentação (10%):** O projeto possui manuais claros e código bem estruturado?

---

## ⚠️ Regras Essenciais do Repositório

> 🛑 **Atenção:**
>
> 1. **Histórico de Commits:** Todas as entregas são cumulativas. O código-fonte deve ser mantido e atualizado obrigatoriamente neste repositório durante todo o semestre acadêmico.
>
> 2. **Evolução Contínua:** Repositórios estagnados que apresentarem atualizações massivas apenas em datas de entrega sem histórico de evolução orgânica estarão sujeitos a severas penalizações na nota.
>
> 3. **Prazo Extrapolado:** Entregas atrasadas estarão sujeitas aos fatores de desconto previamente estipulados em contrato pedagógico.

## Entrega Parcial 3

Nesta etapa foi implementado o CRUD inicial da entidade principal do sistema, o aluno.

### Funcionalidades implementadas

- Conexão com o banco de dados utilizando PDO;
- Banco de dados `mentoria_gestor`;
- Tabela `alunos`;
- Model `Aluno`;
- Cadastro de novos alunos;
- Listagem dos alunos cadastrados;
- Persistência dos dados no banco;
- Formulário para cadastro de aluno;
- Redirecionamento para a listagem após o cadastro.

### Dados cadastrados para o aluno

- Nome;
- E-mail;
- Telefone;
- Concurso-alvo;
- Meta semanal de sessões;
- Data de início da mentoria;
- Plano trimestral, semestral ou anual;
- Situação do aluno.

### Banco de dados

O script para criação do banco e da tabela está disponível em:

```text
database/mentoria_gestor.sql
```

Para executar o projeto localmente:

1. Iniciar Apache e MySQL pelo XAMPP;
2. Importar o arquivo `database/mentoria_gestor.sql` pelo phpMyAdmin;
3. Colocar o projeto dentro de `C:\xampp\htdocs`;
4. Acessar:

```text
http://localhost/meu-projeto-web/public/
```

### CRUD implementado nesta etapa

```text
Create  → Cadastro de aluno
Read    → Listagem dos alunos cadastrados
```

## Entrega Parcial 4

Nesta etapa foi concluído o CRUD da entidade Aluno e foram acrescentadas validações básicas e mensagens de retorno ao usuário.

### Funcionalidades implementadas

- Create: cadastro de alunos;
- Read: listagem dos alunos cadastrados;
- Update: edição dos dados do aluno;
- Delete: exclusão de alunos com confirmação;
- Busca de aluno por ID;
- Validação de campos obrigatórios;
- Validação de formato de e-mail;
- Validação da meta semanal de sessões;
- Validação de plano e situação do aluno;
- Bloqueio de e-mail duplicado;
- Mensagens de sucesso após cadastro, atualização e exclusão;
- Mensagens de erro para dados inválidos ou operações não concluídas.

### Rotas do CRUD de alunos

```text
GET  /alunos             → Listagem
GET  /alunos/criar       → Formulário de cadastro
POST /alunos/salvar      → Cadastro
GET  /alunos/editar      → Formulário de edição
POST /alunos/atualizar   → Atualização
POST /alunos/excluir     → Exclusão
```

Com esta etapa, o gerenciamento da entidade principal do MentoriaGestor passa a contemplar as quatro operações básicas do CRUD.
