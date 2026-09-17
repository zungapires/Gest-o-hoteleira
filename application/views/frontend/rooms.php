<main class="rooms-listing-page">
    <section class="page-banner text-white text-center d-flex align-items-center" style="background-image:url('https://images.unsplash.com/photo-1496417263034-38ec4f0b665a?auto=format&fit=crop&w=1650&q=80'); min-height:40vh;">
        <div class="overlay"></div>
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <h1 class="display-4 fw-bold">Nossos Quartos Premium</h1>
                    <p class="lead text-muted mt-3">Escolha o quarto perfeito para sua estadia inesquecível.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section py-7">
        <div class="container">
            <div class="row gy-4">
                <?php foreach ($rooms as $room): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="room-card rounded-4 overflow-hidden shadow-lg bg-black bg-opacity-60 border border-white border-opacity-10 h-100 d-flex flex-column">
                        <div class="room-image" style="background-image:url('<?= $room['image']; ?>'); min-height:250px;"></div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="h4 text-white mb-1"><?= htmlspecialchars($room['name']); ?></h3>
                                    <span class="badge bg-gold text-dark">MT <?= number_format($room['price'], 0, ',', '.'); ?> / noite</span>
                                </div>
                            </div>
                            <p class="text-muted small mb-2"><?= htmlspecialchars($room['description']); ?></p>
                            <div class="d-flex gap-3 mb-3 text-muted small">
                                <span><i class="fas fa-users me-1"></i> Até <?= $room['capacity']; ?> hóspedes</span>
                                <span><i class="fas fa-door-open me-1"></i> <?= htmlspecialchars($room['type']); ?></span>
                            </div>
                            <div class="mt-auto">
                                <div class="stars text-gold mb-3">
                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i>
                                </div>
                                <a href="<?= base_url('reservar'); ?>" class="btn btn-gold btn-sm w-100 reserve-action">Fazer Reserva</a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="text-muted mb-3">Não encontrou o quarto ideal? Entre em contato com nossa equipe!</p>
                    <a href="<?= base_url('/'); ?>" class="btn btn-outline-light">Voltar para Home</a>
                </div>
            </div>
        </div>
    </section>
</main>
