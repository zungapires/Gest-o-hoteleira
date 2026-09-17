<main class="auth-page min-vh-100 d-flex align-items-center justify-content-center">
    <div class="auth-card rounded-4 shadow-lg p-5 bg-glass">
        <div class="text-center mb-4">
            <h1 class="h3 text-white">Acesse sua conta</h1>
            <p class="text-muted">Entre para gerenciar suas reservas e serviços.</p>
        </div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('login'); ?>">
            <div class="mb-3 form-floating">
                <input type="email" class="form-control bg-dark text-white" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" class="form-control bg-dark text-white" name="password" id="password" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="<?= base_url('forgot'); ?>" class="text-gold small">Esqueceu a senha?</a>
                <button type="submit" class="btn btn-gold px-4">Entrar</button>
            </div>
        </form>
        <div class="text-center text-muted">Ainda não tem conta? <a href="<?= base_url('register'); ?>" class="text-gold">Registrar</a></div>
    </div>
</main>
