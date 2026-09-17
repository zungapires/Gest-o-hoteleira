<div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-white">Perfil do Cliente</h1>
        <p class="text-muted mb-0">Seus dados e reservas atuais.</p>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="profile-card rounded-4 shadow-lg p-4 bg-black bg-opacity-80 border border-white border-opacity-10">
            <h5 class="text-white">Olá, <?= $user['name']; ?></h5>
            <p class="text-muted">Email: <?= $user['email']; ?></p>
            <p class="text-muted">Função: <?= ucfirst($user['role']); ?></p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
            <h5 class="text-white mb-4">Minhas Reservas</h5>
            <div class="table-responsive">
                <table class="table table-dark table-bordered align-middle" id="profileReservations">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Quarto</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <?php $room = current(array_filter($rooms, function ($item) use ($reservation) { return $item['id'] == $reservation['room_id']; })); ?>
                            <tr>
                                <td><?= $reservation['id']; ?></td>
                                <td><?= isset($reservation['reservation_code']) ? $reservation['reservation_code'] : '-'; ?></td>
                                <td><?= $room['name'] ?? 'Quarto'; ?></td>
                                <td><?= $reservation['check_in']; ?></td>
                                <td><?= $reservation['check_out']; ?></td>
                                <td><?= ucfirst($reservation['status']); ?></td>
                                <td>
                                    <?= isset($reservation['payment_status']) ? ucfirst($reservation['payment_status']) : 'Pendente'; ?>
                                    <?php if (isset($reservation['payment_status']) && $reservation['payment_status'] === 'pending'): ?>
                                        <a href="<?= base_url('payment/checkout/' . $reservation['id']); ?>" class="btn btn-sm btn-primary ms-2">Pagar agora</a>
                                    <?php elseif (isset($reservation['payment_status']) && $reservation['payment_status'] === 'paid'): ?>
                                        <a href="<?= base_url('payment/invoice/' . $reservation['id']); ?>" class="btn btn-sm btn-outline-light ms-2">Ver PDF</a>
                                    <?php endif; ?>
                                </td>
                                <td>MT <?= number_format($reservation['total'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
