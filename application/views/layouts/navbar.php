<header class="navbar navbar-expand-lg navbar-dark navbar-floating fixed-top premium-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="<?= base_url(); ?>">
            <span class="brand-mark"><i class="fas fa-crown"></i></span>
            <div>
                <div class="brand-name">Sistema de reserva de hotel</div>
        
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#premiumNav" aria-controls="premiumNav" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="premiumNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-luxury">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url(); ?>">Hotel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('quartos'); ?>">pousadas & resorts</a>
                </li>
             
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('contacto'); ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('consultar'); ?>">Consultar Reserva</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3 nav-right-group">
                <div class="navbar-search d-none d-lg-flex align-items-center">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input class="form-control search-input" type="search" placeholder="Pesquisar reservas, clientes ou quartos" aria-label="Pesquisar">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 header-actions">
                    <button type="button" class="btn btn-icon btn-outline-light d-none d-lg-inline-flex" aria-label="Notificações">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-gold text-dark badge-notification">3</span>
                    </button>
                <?php if (!empty($user)): ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center gap-2 profile-trigger" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="avatar-circle">R</span>
                            <span><?= htmlspecialchars($user['name'] ?? $user['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                            <li><a class="dropdown-item" href="<?= base_url('client/profile'); ?>"><i class="fas fa-user-circle me-2"></i>Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin'); ?>"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('login'); ?>" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="<?= base_url('reservar'); ?>" class="btn btn-gold btn-sm">Reservar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

