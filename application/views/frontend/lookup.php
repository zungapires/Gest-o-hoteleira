<style>
    :root {
        --primary: #c9a961;
        --dark: #1a1a1a;
        --light: #f5f5f5;
    }

    body {
        background-color: var(--light);
    }

    .hero-section {
        background-image: linear-gradient(rgba(26, 26, 26, 0.55), rgba(26, 26, 26, 0.55)), url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1650&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 80px 0;
        text-align: center;
        min-height: 55vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .hero-section p {
        color: #ddd;
        font-size: 1.1rem;
        max-width: 760px;
        margin: 0 auto;
    }

    .lookup-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px 60px;
    }
</style>

<div class="hero-section">
    <div class="container">
        <h1>Consultar Reserva</h1>
        <p>Informe o código da reserva e o e-mail utilizado para ver o status e imprimir o comprovativo.</p>
    </div>
</div>

<main class="lookup-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 bg-black bg-opacity-80 border border-white border-opacity-10 text-white">
                <h3 class="mb-3">Consultar Reserva</h3>
                <p class="text-muted">Informe o código da reserva e o e-mail utilizado para ver o status e imprimir o comprovativo.</p>
                <form id="lookupForm">
                    <div class="mb-3">
                        <label class="form-label">Código da Reserva</label>
                        <input type="text" class="form-control" id="reservation_code" name="reservation_code" placeholder="RES-2026-001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="reservation_email" name="email" placeholder="seu@email.com" required>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-gold" type="submit">Consultar</button>
                    </div>
                </form>

                <div id="lookupResult" class="mt-4 d-none">
                    <h5>Resultado</h5>
                    <div id="resultBody"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(function () {
        $('#lookupForm').on('submit', function (e) {
            e.preventDefault();
            const code = $('#reservation_code').val();
            const email = $('#reservation_email').val();
            if (!code || !email) {
                Swal.fire('Atenção', 'Preencha código e email.', 'warning');
                return;
            }
            $.post(window.appBaseUrl + 'consultar/check', { reservation_code: code, email: email }, function (resp) {
                if (!resp.success) {
                    Swal.fire('Não encontrado', resp.message || 'Reserva não encontrada.', 'error');
                    return;
                }
                const r = resp.reservation;
                const body = [];
                body.push('<p><strong>Código:</strong> ' + (r.reservation_code || r.id) + '</p>');
                body.push('<p><strong>Nome:</strong> ' + (r.guest_name || r.user_id || '—') + '</p>');
                body.push('<p><strong>E-mail:</strong> ' + (r.guest_email || '—') + '</p>');
                body.push('<p><strong>Telefone:</strong> ' + (r.guest_phone || '—') + '</p>');
                body.push('<p><strong>Quarto:</strong> ' + (r.room_id || '—') + '</p>');
                body.push('<p><strong>Check-in:</strong> ' + (r.check_in || '—') + '</p>');
                body.push('<p><strong>Check-out:</strong> ' + (r.check_out || '—') + '</p>');
                body.push('<p><strong>Status:</strong> ' + (r.status || '—') + '</p>');

                let actions = '<div class="mt-3">';
                if (r.payment_status && r.payment_status === 'paid') {
                    actions += '<a class="btn btn-outline-light me-2" href="' + window.appBaseUrl + 'payment/invoice/' + r.id + '" target="_blank">Imprimir Comprovativo</a>';
                }
                actions += '<button class="btn btn-danger" id="cancelReservation">Cancelar Reserva</button>';
                actions += '</div>';

                $('#resultBody').html(body.join('\n') + actions);
                $('#lookupResult').removeClass('d-none');

                $('#cancelReservation').on('click', function () {
                    Swal.fire({ title: 'Cancelar reserva?', text: 'Deseja cancelar esta reserva?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Sim, cancelar' }).then(function (res) {
                        if (!res.isConfirmed) return;
                        $.post(window.appBaseUrl + 'consultar/cancel', { id: r.id, reservation_code: r.reservation_code, email: ($('#reservation_email').val()) }, function (resp2) {
                            if (resp2.success) {
                                Swal.fire('Cancelada', resp2.message, 'success').then(function () { location.reload(); });
                            } else {
                                Swal.fire('Erro', resp2.message || 'Não foi possível cancelar.', 'error');
                            }
                        }, 'json');
                    });
                });
            }, 'json').fail(function () { Swal.fire('Erro', 'Falha ao consultar reserva.', 'error'); });
        });
    });
</script>
