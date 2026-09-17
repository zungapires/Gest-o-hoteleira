<main class="auth-page min-vh-100 d-flex align-items-center justify-content-center">
    <div class="auth-card rounded-4 shadow-lg p-5 bg-glass">
        <div class="text-center mb-4">
            <h1 class="h3 text-white">Recuperar senha</h1>
            <p class="text-muted">Informe seu email para receber instruções de redefinição.</p>
        </div>
        <form method="post" action="<?= base_url('forgot'); ?>">
            <div class="mb-3 form-floating">
                <input type="email" class="form-control bg-dark text-white" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <button type="submit" class="btn btn-gold btn-lg w-100">Enviar instruções</button>
        </form>
        <div class="text-center text-muted mt-3">Lembrou sua senha? <a href="<?= base_url('login'); ?>" class="text-gold">Entrar</a></div>
    </div>
</main>
