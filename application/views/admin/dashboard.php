<div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-white">Dashboard</h1>
        <p class="text-muted mb-0">Painel administrativo premium</p>
    </div>
    <div>
        <span class="badge bg-gold text-dark">Admin</span>
    </div>
</div>
<div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="dashboard-card bg-black bg-opacity-75 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
            <h6 class="text-muted">Reservas</h6>
            <h2 class="text-white"><?= $stats['reservations']; ?></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="dashboard-card bg-black bg-opacity-75 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
            <h6 class="text-muted">Clientes</h6>
            <h2 class="text-white"><?= $stats['clients']; ?></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="dashboard-card bg-black bg-opacity-75 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
            <h6 class="text-muted">Quartos</h6>
            <h2 class="text-white"><?= $stats['rooms']; ?></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="dashboard-card bg-black bg-opacity-75 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
            <h6 class="text-muted">Receita</h6>
            <h2 class="text-white">MT <?= number_format($stats['revenue'], 0, ',', '.'); ?></h2>
        </div>
    </div>
</div>
<div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10 mb-5">
    <div class="card-body">
        <h5 class="text-white">Relatórios recentes</h5>
        <p class="text-muted">Visão rápida das últimas reservas e performance do sistema.</p>
        <div class="table-responsive mt-4">
            <table class="table table-dark table-striped rounded-4" id="dashboardTable">
                <thead>
                    <tr>
                        <th>Reserva</th>
                        <th>Quarto</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($reservations_list, 0, 6) as $reservation): ?>
                        <tr>
                            <td>#<?= $reservation['id']; ?></td>
                            <td><?= isset($rooms[array_search($reservation['room_id'], array_column($rooms, 'id'))]['name']) ? $rooms[array_search($reservation['room_id'], array_column($rooms, 'id'))]['name'] : 'Quarto'; ?></td>
                            <td><?= ucfirst($reservation['status']); ?></td>
                            <td>MT <?= number_format($reservation['total'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
