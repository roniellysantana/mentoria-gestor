<section class="pagina">

    <div class="pagina-cabecalho">
        <div>
            <h2>Cadastrar aluno</h2>
            <p>Preencha os dados do novo aluno da mentoria.</p>
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
        action="/meu-projeto-web/public/alunos/salvar"
    >

        <div class="campo">
            <label for="nome">Nome</label>
            <input
                type="text"
                id="nome"
                name="nome"
                value="<?= htmlspecialchars($dados['nome'] ?? '') ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($dados['email'] ?? '') ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="telefone">Telefone</label>
            <input
                type="text"
                id="telefone"
                name="telefone"
                value="<?= htmlspecialchars($dados['telefone'] ?? '') ?>"
            >
        </div>

        <div class="campo">
            <label for="concurso_alvo">Concurso-alvo</label>
            <input
                type="text"
                id="concurso_alvo"
                name="concurso_alvo"
                value="<?= htmlspecialchars($dados['concurso_alvo'] ?? '') ?>"
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
                value="<?= htmlspecialchars($dados['meta_semanal_sessoes'] ?? '') ?>"
                required
            >
        </div>

        <div class="campo">
            <label for="data_inicio">Início da mentoria</label>
            <input
                type="date"
                id="data_inicio"
                name="data_inicio"
                value="<?= htmlspecialchars($dados['data_inicio'] ?? '') ?>"
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
                <option value="">Selecione</option>
                <option value="trimestral" <?= ($dados['plano'] ?? '') === 'trimestral' ? 'selected' : '' ?>>
                    Trimestral
                </option>
                <option value="semestral" <?= ($dados['plano'] ?? '') === 'semestral' ? 'selected' : '' ?>>
                    Semestral
                </option>
                <option value="anual" <?= ($dados['plano'] ?? '') === 'anual' ? 'selected' : '' ?>>
                    Anual
                </option>
            </select>
        </div>

        <div class="acoes-formulario">
            <button class="botao" type="submit">
                Cadastrar aluno
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
