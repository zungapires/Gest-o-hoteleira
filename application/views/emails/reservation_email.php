<div style="font-family: Arial, sans-serif; color: #222;">
    <h2>Confirmação de Reserva #<?= $reservation['id']; ?></h2>
    <p>Olá <?= !empty($reservation['guest_name']) ? htmlspecialchars($reservation['guest_name']) : 'Cliente'; ?>,</p>
    <p>Sua reserva foi processada. Seguem os detalhes:</p>
    <ul>
        <li><strong>Quarto:</strong> <?= isset($room['name']) ? htmlspecialchars($room['name']) : '—'; ?></li>
        <li><strong>Local:</strong> <?= htmlspecialchars($hotel_location ?? 'Endereço do hotel'); ?></li>
        <li><strong>Check-in:</strong> <?= htmlspecialchars($reservation['check_in']); ?></li>
        <li><strong>Check-out:</strong> <?= htmlspecialchars($reservation['check_out']); ?></li>
        <li><strong>Noites:</strong> <?= isset($nights) ? htmlspecialchars($nights) : '—'; ?></li>
        <li><strong>Horário de chegada:</strong> <?= htmlspecialchars($reservation['arrival_time']); ?></li>
        <li><strong>Hóspedes:</strong> <?= htmlspecialchars($reservation['guests']); ?></li>
        <li><strong>Valor por noite:</strong> MT <?= isset($room['price']) ? number_format($room['price'], 2, ',', '.') : '—'; ?></li>
        <li><strong>Valor total:</strong> MT <?= number_format($reservation['total'], 2, ',', '.'); ?></li>
    </ul>
    <p>O comprovante em PDF está em anexo.</p>
    <p>Atenciosamente,<br/>Equipe do Hotel</p>
</div>
