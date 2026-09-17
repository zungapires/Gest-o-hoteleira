<div class="admin-shell d-flex">
    <aside class="admin-sidebar shadow-glass">
        <div class="brand">
            <div class="brand-icon"><i class="fas fa-crown"></i></div>
            <div>
                <h4>RoyaleHotel</h4>
                <p>Admin Premium</p>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <nav class="sidebar-menu">
            <a class="nav-link active" href="<?= base_url('admin'); ?>"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a class="nav-link" href="<?= base_url('admin/rooms'); ?>"><i class="fas fa-bed"></i> Quartos</a>
            <a class="nav-link" href="<?= base_url('admin/reservations'); ?>"><i class="fas fa-calendar-check"></i> Reservas</a>
            <a class="nav-link" href="<?= base_url('admin/clients'); ?>"><i class="fas fa-users"></i> Clientes</a>
            <a class="nav-link" href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </nav>
    </aside>
    <main class="admin-content container-fluid">
