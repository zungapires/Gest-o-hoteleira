<main class="reservation-page">
    <section class="hero-banner text-white text-center d-flex align-items-center" style="background-image:url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1650&q=80'); min-height:60vh;">
        <div class="overlay"></div>
        <div class="container position-relative py-5">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <span class="eyebrow text-gold">Reserva dedicada</span>
                    <h1 class="display-5 fw-bold">Reserve sua estadia com estilo</h1>
                    <p class="lead text-white-75 mt-3">Preencha o formulário abaixo para solicitar sua reserva premium. Nós cuidamos do restante.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-light text-dark py-7">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="booking-form card border-0 shadow-lg overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-5 bg-dark text-white p-5 d-flex flex-column justify-content-center">
                                <span class="eyebrow text-gold">Hotel Booking</span>
                                <h2 class="fw-bold">Formulário de reserva</h2>
                                <p class="text-muted">Escolha o quarto, datas e serviços extras de forma simples e segura.</p>
                                <ul class="text-muted list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-check text-gold me-2"></i> Reserva segura em JSON</li>
                                    <li class="mb-2"><i class="fas fa-check text-gold me-2"></i> Opções de pickup e solicitações</li>
                                    <li><i class="fas fa-check text-gold me-2"></i> Confirmação rápida pela equipe</li>
                                </ul>
                            </div>
                            <div class="col-lg-7 p-5">
                                <form id="reservationForm">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nome completo</label>
                                            <input type="text" class="form-control form-control-lg" id="guest_name" name="guest_name" placeholder="Seu nome" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control form-control-lg" id="guest_email" name="guest_email" placeholder="seu@email.com" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Telefone</label>
                                            <input type="text" class="form-control form-control-lg" id="guest_phone" name="guest_phone" placeholder="(84) 90000-0000" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Documento (CPF/ID)</label>
                                            <input type="text" class="form-control form-control-lg" id="guest_document" name="guest_document" placeholder="CPF ou documento" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tipo de quarto</label>
                                            <select class="form-select form-select-lg" id="type" name="type" required>
                                                <option value="">Selecione o quarto</option>
                                                <?php $roomTypes = []; foreach ($rooms as $room): if (!in_array($room['type'], $roomTypes)): $roomTypes[] = $room['type']; ?>
                                                <option value="<?= htmlspecialchars($room['type']); ?>"><?= htmlspecialchars($room['type']); ?></option>
                                                <?php endif; endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Número de hóspedes</label>
                                            <input type="number" class="form-control form-control-lg" id="guests" name="guests" min="1" max="8" value="2" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Data de chegada</label>
                                            <input type="date" class="form-control form-control-lg" id="check_in" name="check_in" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Hora de chegada</label>
                                            <input type="time" class="form-control form-control-lg" id="arrival_time" name="arrival_time" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Data de partida</label>
                                            <input type="date" class="form-control form-control-lg" id="check_out" name="check_out" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pickup gratuito</label>
                                            <div class="d-flex gap-3 align-items-center pickup-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pickup" id="pickup_yes" value="yes" checked>
                                                    <label class="form-check-label" for="pickup_yes">Sim</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pickup" id="pickup_no" value="no">
                                                    <label class="form-check-label" for="pickup_no">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Pedidos especiais</label>
                                            <textarea class="form-control form-control-lg" id="special_requests" name="special_requests" rows="4" placeholder="Alguma solicitação especial?"></textarea>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-gold btn-lg px-5">Enviar Reserva</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
