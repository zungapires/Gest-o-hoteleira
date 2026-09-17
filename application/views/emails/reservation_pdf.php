<html>
<head>
    <meta charset="utf-8" />
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { width: 100%; border-collapse: collapse; }
        .details td { padding: 6px; vertical-align: top; }
        .total { font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprovante de Reserva #<?= $reservation['id']; ?></h1>
        <p>Hotel — Confirmação de Reserva</p>
    </div>

    <table class="details">
        <tr>
            <td><strong>Hóspede:</strong></td>
            <td><?= !empty($reservation['guest_name']) ? htmlspecialchars($reservation['guest_name']) : '—'; ?></td>
        </tr>
        <tr>
            <td><strong>E-mail:</strong></td>
            <td><?= !empty($reservation['guest_email']) ? htmlspecialchars($reservation['guest_email']) : '—'; ?></td>
        </tr>
        <tr>
            <td><strong>Quarto:</strong></td>
            <td><?= isset($room_number) ? htmlspecialchars($room_number) : (isset($room['name']) ? htmlspecialchars($room['name']) : '—'); ?></td>
        </tr>
        <tr>
            <td><strong>Local:</strong></td>
            <td><?= htmlspecialchars($hotel_location ?? 'Endereço do hotel'); ?></td>
        </tr>
        <tr>
            <td><strong>Check-in:</strong></td>
            <td><?= htmlspecialchars($reservation['check_in']); ?></td>
        </tr>
        <tr>
            <td><strong>Check-out:</strong></td>
            <td><?= htmlspecialchars($reservation['check_out']); ?></td>
        </tr>
        <tr>
            <td><strong>Noites:</strong></td>
            <td><?= isset($nights) ? htmlspecialchars($nights) : '—'; ?></td>
        </tr>
        <tr>
            <td><strong>Hora de chegada:</strong></td>
            <td><?= htmlspecialchars($reservation['arrival_time']); ?></td>
        </tr>
        <tr>
            <td><strong>Hóspedes:</strong></td>
            <td><?= htmlspecialchars($reservation['guests']); ?></td>
        </tr>
        <tr>
            <td><strong>Valor por noite:</strong></td>
            <td>MT <?= isset($room['price']) ? number_format($room['price'], 2, ',', '.') : '—'; ?></td>
        </tr>
        <tr>
            <td><strong>Observações:</strong></td>
            <td><?= nl2br(htmlspecialchars($reservation['special_requests'] ?? '—')); ?></td>
        </tr>
    </table>

    <p class="total">Total pago: MT <?= number_format($reservation['total'], 2, ',', '.'); ?></p>

    <hr/>
    <p>Obrigado por reservar conosco.</p>
</body>
</html>
