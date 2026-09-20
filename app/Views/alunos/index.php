<section class="pagina">
    <div class="pagina-cabecalho">
        <div>
            <h2>Alunos</h2>
            <p>Gerenciamento dos alunos cadastrados na mentoria.</p>
        </div>

        <a class="botao" href="/meu-projeto-web/public/alunos/criar">
            Cadastrar aluno
        </a>
    </div>

    <div class="tabela-container">
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Concurso-alvo</th>
                    <th>Plano</th>
                    <th>Meta semanal</th>
                    <th>Situação</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($alunos)): ?>

                    <tr>
                        <td colspan="5">
                            Nenhum aluno cadastrado.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($alunos as $aluno): ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars($aluno['nome']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($aluno['concurso_alvo']) ?>
                            </td>

                            <td>
                                <?= ucfirst(htmlspecialchars($aluno['plano'])) ?>
                            </td>

                            <td>
                                <?= (int) $aluno['meta_semanal_sessoes'] ?> sessões
                            </td>

                            <td>
                                <span class="status <?= $aluno['status'] === 'ativo' ? 'ativo' : '' ?>">
                                    <?= ucfirst(htmlspecialchars($aluno['status'])) ?>
                                </span>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>