<main class="container py-6">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 text-white">Pagamento da Reserva #<?= $reservation['id']; ?></h1>
                    <p class="text-muted mb-0">Finalize a sua reserva com segurança e receba a confirmação por e-mail.</p>
                </div>
                <span class="badge bg-gold text-dark py-2 px-3">Status: <?= ucfirst($payment['status'] ?? 'pending'); ?></span>
            </div>
            <div class="row g-4">
                <div class="col-xl-6">
                    <div class="card bg-dark border-secondary shadow-lg h-100">
                        <div class="card-body">
                            <h5 class="card-title text-white mb-4">Resumo da reserva</h5>
                            <dl class="row text-white-75 mb-0">
                                <dt class="col-5">Quarto</dt>
                                <dd class="col-7 text-white"><?= $room['name'] ?? 'Quarto'; ?></dd>
                                <dt class="col-5">Check-in</dt>
                                <dd class="col-7 text-white"><?= htmlspecialchars($reservation['check_in']); ?></dd>
                                <dt class="col-5">Check-out</dt>
                                <dd class="col-7 text-white"><?= htmlspecialchars($reservation['check_out']); ?></dd>
                                <dt class="col-5">Hóspede</dt>
                                <dd class="col-7 text-white"><?= htmlspecialchars($reservation['guest_name']); ?></dd>
                                <dt class="col-5">Email</dt>
                                <dd class="col-7 text-white"><?= htmlspecialchars($reservation['guest_email']); ?></dd>
                                <dt class="col-5">Total</dt>
                                <dd class="col-7 text-white">MT <?= number_format($reservation['total'], 2, ',', '.'); ?></dd>
                                <dt class="col-5">Código</dt>
                                <dd class="col-7 text-white"><?= isset($reservation['reservation_code']) ? $reservation['reservation_code'] : '-'; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card bg-black border-white border-opacity-10 shadow-lg h-100">
                        <div class="card-body">
                            <h5 class="card-title text-white mb-4">Confirmar pagamento</h5>
                            <?php if (!empty($requires_email)): ?>
                                <div class="mb-4">
                                    <label class="form-label text-white">Confirme seu e-mail</label>
                                    <input id="guestEmail" class="form-control form-control-lg bg-dark text-white border-secondary" type="email" placeholder="Seu e-mail usado na reserva" required>
                                    <div class="form-text text-white-50">Digite o e-mail usado na reserva para validar o pagamento.</div>
                                </div>
                            <?php endif; ?>
                            <div class="alert alert-warning bg-opacity-25 border-warning text-warning mb-4">
                                <strong>Atenção:</strong> Este é um pagamento simulado. O sistema marcará como pago e enviará a confirmação por e-mail.
                            </div>
                            <button id="processPayment" class="btn btn-gold btn-lg w-100 mb-3">Pagar MT <?= number_format($reservation['total'], 2, ',', '.'); ?></button>
                            <a href="<?= base_url('client/profile'); ?>" class="btn btn-outline-light btn-lg w-100">Voltar ao Perfil</a>
                            <div id="paymentResult" class="mt-4 d-none">
                                <div class="alert alert-success" id="paymentResultMessage"></div>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a id="viewInvoiceButton" href="#" class="btn btn-outline-light d-none">Ver PDF</a>
                                    <a id="stayButton" href="#" class="btn btn-secondary d-none">Permanecer na página</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const processButton = document.getElementById('processPayment');
    const resultBox = document.getElementById('paymentResult');
    const resultMessage = document.getElementById('paymentResultMessage');
    const viewInvoiceButton = document.getElementById('viewInvoiceButton');
    const stayButton = document.getElementById('stayButton');
    const requiresEmail = <?= !empty($requires_email) ? 'true' : 'false'; ?>;
    const guestEmailField = document.getElementById('guestEmail');
    const pesoTotal = 'MT <?= number_format($reservation['total'], 2, ',', '.'); ?>';

    function resetButton() {
        processButton.disabled = false;
        processButton.textContent = 'Pagar ' + pesoTotal;
    }

    function showError(message) {
        Swal.fire({ icon: 'error', title: 'Falha no pagamento', text: message });
        resetButton();
    }

    if (processButton) {
        processButton.addEventListener('click', function () {
            processButton.disabled = true;
            processButton.textContent = 'Processando...';

            const payload = {};
            if (requiresEmail) {
                const guestEmail = guestEmailField ? guestEmailField.value.trim() : '';
                if (!guestEmail) {
                    Swal.fire({ icon: 'warning', title: 'E-mail obrigatório', text: 'Informe o e-mail usado na reserva para continuar.' });
                    resetButton();
                    return;
                }
                payload.guest_email = guestEmail;
            }

            fetch('<?= base_url('payment/process/' . $reservation['id']); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            }).then(response => response.json()).then(data => {
                if (!data.success) {
                    showError(data.message || 'Falha ao processar o pagamento.');
                    return;
                }

                const successMessage = data.message || 'Pagamento concluído com sucesso.';
                const emailNote = data.email_sent ? ' Um e-mail de confirmação foi enviado para o endereço informado.' : ' Não foi possível enviar o e-mail de confirmação.';
                resultMessage.textContent = successMessage + emailNote;
                if (viewInvoiceButton) {
                    viewInvoiceButton.href = window.appBaseUrl + 'payment/invoice/' + data.reservation_id;
                    viewInvoiceButton.classList.remove('d-none');
                }
                if (stayButton) {
                    stayButton.href = window.location.href;
                    stayButton.classList.remove('d-none');
                }
                resultBox.classList.remove('d-none');
                processButton.classList.add('d-none');
                if (data.redirect) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pagamento concluído',
                        html: successMessage + '<br>' + (data.email_sent ? 'Verificamos o envio do e-mail de confirmação.' : 'O e-mail não pôde ser enviado.'),
                        confirmButtonText: 'Ir para o perfil'
                    }).then(function () {
                        window.location.href = data.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pagamento concluído',
                        html: successMessage + '<br>' + (data.email_sent ? 'Um e-mail de confirmação foi enviado.' : 'Não foi possível enviar o e-mail de confirmação.'),
                        confirmButtonText: 'Continuar na página'
                    });
                }
            }).catch(() => {
                showError('Erro ao processar o pagamento. Tente novamente mais tarde.');
            });
        });
    }
});
</script>
