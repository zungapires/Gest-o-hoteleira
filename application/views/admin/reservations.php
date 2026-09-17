<div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-white">Reservas</h1>
        <p class="text-muted mb-0">Acompanhe as solicitações e confirme estadias.</p>
    </div>
</div>
<div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle" id="reservationsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Quarto</th>
                    <th>Hóspede</th>
                    <th>E-mail</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Pagamento</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation):
                    $roomIndex = array_search($reservation['room_id'], array_column($rooms, 'id'));
                    $roomName = $roomIndex !== false && isset($rooms[$roomIndex]['name']) ? $rooms[$roomIndex]['name'] : 'Quarto';
                ?>
                <tr>
                    <td><?= $reservation['id']; ?></td>
                    <td><?= isset($reservation['reservation_code']) ? $reservation['reservation_code'] : '-'; ?></td>
                    <td><?= $roomName; ?></td>
                    <td><?= !empty($reservation['guest_name']) ? htmlspecialchars($reservation['guest_name']) : 'Cliente #' . $reservation['user_id']; ?></td>
                    <td><?= !empty($reservation['guest_email']) ? htmlspecialchars($reservation['guest_email']) : '---'; ?></td>
                    <td><?= htmlspecialchars($reservation['check_in']); ?></td>
                    <td><?= htmlspecialchars($reservation['check_out']); ?></td>
                    <td><?= ucfirst($reservation['status']); ?></td>
                    <td><?= isset($reservation['payment_status']) ? ucfirst($reservation['payment_status']) : 'Pendente'; ?></td>
                    <td>MT <?= number_format($reservation['total'], 2, ',', '.'); ?></td>
                    <td>
                        <?php if ($reservation['status'] === 'pending'): ?>
                            <button class="btn btn-sm btn-success confirm-reservation" data-id="<?= $reservation['id']; ?>">Confirmar</button>
                        <?php endif; ?>
                        <?php if ($reservation['status'] !== 'cancelled'): ?>
                            <button class="btn btn-sm btn-danger cancel-reservation" data-id="<?= $reservation['id']; ?>">Cancelar</button>
                        <?php endif; ?>
                        <button class="btn btn-sm btn-outline-light email-reservation" data-id="<?= $reservation['id']; ?>">Enviar e-mail/PDF</button>
                        <?php if (isset($reservation['payment_status']) && $reservation['payment_status'] === 'paid'): ?>
                            <a href="<?= base_url('payment/invoice/' . $reservation['id']); ?>" class="btn btn-sm btn-secondary mt-1">Ver PDF</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</main>
