<?php $this->load->view('layouts/header'); ?>
<style>
    :root {
        --primary: #c9a961;
        --dark: #1a1a1a;
        --light: #f5f5f5;
        --success: #27ae60;
        --danger: #e74c3c;
        --warning: #f39c12;
    }

    .dashboard-container {
        background: var(--light);
        min-height: 100vh;
        padding: 40px 0;
    }

    .page-header {
        background: linear-gradient(135deg, var(--dark) 0%, #2d2d2d 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        color: #ddd;
        margin: 10px 0 0 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-left: 4px solid var(--primary);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(201, 169, 97, 0.2);
    }

    .stat-card.success {
        border-left-color: var(--success);
    }

    .stat-card.danger {
        border-left-color: var(--danger);
    }

    .stat-card.warning {
        border-left-color: var(--warning);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .stat-label {
        color: #666;
        margin-top: 8px;
        font-size: 0.95rem;
    }

    .dashboard-section {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--primary);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        margin: 0;
    }

    .table th {
        background-color: var(--dark);
        color: white;
        font-weight: 600;
        border: none;
    }

    .table td {
        vertical-align: middle;
        padding: 12px;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge.available {
        background-color: rgba(39, 174, 96, 0.2);
        color: var(--success);
    }

    .badge.unavailable {
        background-color: rgba(231, 76, 60, 0.2);
        color: var(--danger);
    }

    .actions-btn {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    .quick-action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .quick-action-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .quick-action-btn:hover {
        background: #b8944d;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.8rem;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .table {
            font-size: 0.9rem;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-chart-line"></i> Dashboard Administrativo</h1>
        <p>Bem-vindo ao painel de controle do hotel</p>
    </div>
</div>

<div class="dashboard-container">
    <div class="container">
        <!-- Key Metrics -->
        <div class="dashboard-grid">
            <div class="stat-card">
                <h3 class="stat-number"><?php echo count($rooms ?? []); ?></h3>
                <p class="stat-label"><i class="fas fa-door-open"></i> Quartos Disponíveis</p>
            </div>
            <div class="stat-card success">
                <h3 class="stat-number">12</h3>
                <p class="stat-label"><i class="fas fa-check-circle"></i> Reservas Hoje</p>
            </div>
            <div class="stat-card warning">
                <h3 class="stat-number">8</h3>
                <p class="stat-label"><i class="fas fa-hourglass-end"></i> Check-in Pendente</p>
            </div>
            <div class="stat-card danger">
                <h3 class="stat-number">2</h3>
                <p class="stat-label"><i class="fas fa-user-slash"></i> Cancelamentos</p>
            </div>
            <div class="stat-card">
                <h3 class="stat-number">156</h3>
                <p class="stat-label"><i class="fas fa-users"></i> Hóspedes Ativos</p>
            </div>
            <div class="stat-card">
                <h3 class="stat-number">MT 24.5K</h3>
                <p class="stat-label"><i class="fas fa-money-bill-wave"></i> Faturamento Mês</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-section">
            <h2 class="section-title"><i class="fas fa-bolt"></i> Ações Rápidas</h2>
            <div class="quick-action-grid">
                <a href="<?= base_url('admin/rooms'); ?>" class="quick-action-btn">
                    <i class="fas fa-door-open"></i> Gerenciar Quartos
                </a>
                <a href="<?= base_url('admin/reservations'); ?>" class="quick-action-btn">
                    <i class="fas fa-calendar-alt"></i> Reservas
                </a>
                <a href="<?= base_url('admin/clients'); ?>" class="quick-action-btn">
                    <i class="fas fa-users"></i> Hóspedes
                </a>
                <a href="<?= base_url('quartos'); ?>" class="quick-action-btn">
                    <i class="fas fa-image"></i> Galeria
                </a>
                <a href="<?= base_url('servicos'); ?>" class="quick-action-btn">
                    <i class="fas fa-concierge-bell"></i> Serviços
                </a>
                <a href="<?= base_url('contacto'); ?>" class="quick-action-btn">
                    <i class="fas fa-envelope"></i> Mensagens
                </a>
            </div>
        </div>

        <!-- Rooms Overview -->
        <div class="dashboard-section">
            <h2 class="section-title"><i class="fas fa-door-open"></i> Visão Geral dos Quartos</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Quarto</th>
                            <th>Tipo</th>
                            <th>Capacidade</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rooms)): ?>
                            <?php foreach (array_slice($rooms, 0, 5) as $room): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($room['name']); ?></strong></td>
                                    <td><?= htmlspecialchars($room['type']); ?></td>
                                    <td><i class="fas fa-users"></i> <?= $room['capacity']; ?></td>
                                    <td>MT <?= number_format($room['price'], 2, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge <?= ($room['status'] == 'available' ? 'available' : 'unavailable'); ?>">
                                            <?= ucfirst($room['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions-btn">
                                            <a href="<?= base_url('admin/rooms'); ?>" class="btn btn-sm btn-primary">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhum quarto registrado</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="<?= base_url('admin/rooms'); ?>" class="btn btn-primary mt-3">Ver Todos os Quartos</a>
            </div>
        </div>

        <!-- System Status -->
        <div class="dashboard-section">
            <h2 class="section-title"><i class="fas fa-server"></i> Status do Sistema</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div>
                    <strong>Servidor Web</strong>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                        <span style="width: 12px; height: 12px; background: var(--success); border-radius: 50%;"></span>
                        <span>Online</span>
                    </div>
                </div>
                <div>
                    <strong>Banco de Dados</strong>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                        <span style="width: 12px; height: 12px; background: var(--success); border-radius: 50%;"></span>
                        <span>Conectado</span>
                    </div>
                </div>
                <div>
                    <strong>Email Service</strong>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                        <span style="width: 12px; height: 12px; background: #f39c12; border-radius: 50%;"></span>
                        <span>Configurado</span>
                    </div>
                </div>
                <div>
                    <strong>Backup Automático</strong>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                        <span style="width: 12px; height: 12px; background: var(--success); border-radius: 50%;"></span>
                        <span>Ativo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>

