<section class="pagina pagina-login">

    <div class="login-container">

        <div class="login-cabecalho">
            <h2>Entrar no MentoriaGestor</h2>
            <p>Informe seu e-mail e senha para acessar o sistema.</p>
        </div>

        <?php if (!empty($erro)): ?>

            <div class="mensagem mensagem-erro">
                ⚠ <?= htmlspecialchars($erro) ?>
            </div>

        <?php endif; ?>

        <form
            class="formulario"
            method="POST"
            action="/meu-projeto-web/public/login"
        >

            <div class="campo">
                <label for="email">E-mail</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="campo">
                <label for="senha">Senha</label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button class="botao botao-login" type="submit">
                Entrar
            </button>

        </form>

    </div>

</section>
