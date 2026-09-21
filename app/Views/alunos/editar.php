<section class="pagina">

    <div class="pagina-cabecalho">
        <div>
            <h2>Editar aluno</h2>
            <p>Atualize os dados do aluno.</p>
        </div>
    </div>

    <?php if (!empty($erros)): ?>
        <div class="mensagem mensagem-erro">
            <strong>⚠ Verifique os dados informados:</strong>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form
        class="formulario"
        method="POST"
        action="/meu-projeto-web/public/alunos/atualizar"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $aluno['id'] ?>"
        >

        <div class="campo">
            <label for="nome">Nome</label>
            <input
                type="text"
                id="nome"
                name="nome"
                value="<?= htmlspecialchars($aluno['nome']) ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($aluno['email']) ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="telefone">Telefone</label>
            <input
                type="text"
                id="telefone"
                name="telefone"
                value="<?= htmlspecialchars($aluno['telefone']) ?>"
            >
        </div>

        <div class="campo">
            <label for="concurso_alvo">Concurso-alvo</label>
            <input
                type="text"
                id="concurso_alvo"
                name="concurso_alvo"
                value="<?= htmlspecialchars($aluno['concurso_alvo']) ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="meta_semanal_sessoes">
                Meta semanal de sessões
            </label>
            <input
                type="number"
                id="meta_semanal_sessoes"
                name="meta_semanal_sessoes"
                min="1"
                value="<?= (int) $aluno['meta_semanal_sessoes'] ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="data_inicio">Início da mentoria</label>
            <input
                type="date"
                id="data_inicio"
                name="data_inicio"
                value="<?= htmlspecialchars($aluno['data_inicio']) ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="plano">Plano</label>
            <select
                id="plano"
                name="plano"
                required
            >
                <option value="trimestral" <?= $aluno['plano'] === 'trimestral' ? 'selected' : '' ?>>
                    Trimestral
                </option>
                <option value="semestral" <?= $aluno['plano'] === 'semestral' ? 'selected' : '' ?>>
                    Semestral
                </option>
                <option value="anual" <?= $aluno['plano'] === 'anual' ? 'selected' : '' ?>>
                    Anual
                </option>
            </select>
        </div>

        <div class="campo">
            <label for="status">Situação</label>
            <select
                id="status"
                name="status"
                required
            >
                <option value="ativo" <?= $aluno['status'] === 'ativo' ? 'selected' : '' ?>>
                    Ativo
                </option>
                <option value="inativo" <?= $aluno['status'] === 'inativo' ? 'selected' : '' ?>>
                    Inativo
                </option>
            </select>
        </div>

        <div class="acoes-formulario">
            <button class="botao" type="submit">
                Salvar alterações
            </button>

            <a
                class="botao botao-secundario"
                href="/meu-projeto-web/public/alunos"
            >
                Cancelar
            </a>
        </div>

    </form>

</section>
