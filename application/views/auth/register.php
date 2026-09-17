<main class="auth-page min-vh-100 d-flex align-items-center justify-content-center">
    <div class="auth-card rounded-4 shadow-lg p-5 bg-glass">
        <div class="text-center mb-4">
            <h1 class="h3 text-white">Criar nova conta</h1>
            <p class="text-muted">Cadastre-se para reservar quartos e ver seu histórico.</p>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('register'); ?>">
            <div class="mb-3 form-floating">
                <input type="text" class="form-control bg-dark text-white" name="name" id="name" placeholder="Nome" required>
                <label for="name">Nome</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="email" class="form-control bg-dark text-white" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" class="form-control bg-dark text-white" name="password" id="password" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" class="form-control bg-dark text-white" name="confirm_password" id="confirm_password" placeholder="Confirmar senha" required>
                <label for="confirm_password">Confirmar senha</label>
            </div>
            <button type="submit" class="btn btn-gold btn-lg w-100">Registrar</button>
        </form>
        <div class="text-center text-muted mt-3">Já possui conta? <a href="<?= base_url('login'); ?>" class="text-gold">Entrar</a></div>
    </div>
</main>
