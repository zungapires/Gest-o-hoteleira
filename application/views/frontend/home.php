<main id="home" class="hero-section position-relative overflow-hidden">
    <section class="hero-banner hero-home text-white text-center d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <span class="eyebrow text-gold">Hospitalidade exclusiva</span>
                    <h1 class="display-4 fw-bold">Descubra a melhor experiência de hospedagem</h1>
                    <p class="lead text-muted mt-3">Viva o conforto premium, exclusividade e reservas instantâneas no seu próximo destino.</p>
                    <div class="btn-group mt-5">
                        <a href="<?= base_url('reservar'); ?>" class="btn btn-gold btn-lg shadow-lg reserve-action">Reservar Agora</a>
                        <a href="<?= base_url('quartos'); ?>" class="btn btn-outline-light btn-lg">Ver Quartos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="reservations" class="section py-5">
    <div class="container text-center">
        <span class="eyebrow text-gold">Reserva Premium</span>
        <h2 class="fw-bold">Faça sua reserva em uma página dedicada</h2>
        <p class="text-muted mx-auto" style="max-width: 680px;">Acesse o formulário completo de reserva para escolher datas, quarto e serviços extras.</p>
        <a href="<?= base_url('reservar'); ?>" class="btn btn-gold btn-lg mt-4 reserve-action">Ir para Reserva</a>
    </div>
</section>

<section id="rooms" class="section bg-dark text-white py-7">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="eyebrow text-gold">Quartos de luxo</span>
            <h2 class="fw-bold">Quartos premium prontos para você</h2>
            <p class="text-muted">Selecione a sua experiência e viva uma estadia inesquecível.</p>
        </div>
        <?php $homeRoomSlides = array_chunk(!empty($rooms) ? $rooms : [], 3); ?>
        <div id="homeRoomCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="false" data-bs-wrap="true" data-bs-touch="true">
            <div class="carousel-indicators mb-4">
                <?php foreach ($homeRoomSlides as $index => $slide): ?>
                    <button type="button" data-bs-target="#homeRoomCarousel" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1; ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($homeRoomSlides as $slideIndex => $slideRooms): ?>
                    <div class="carousel-item <?= $slideIndex === 0 ? 'active' : ''; ?>">
                        <div class="row gy-4">
                            <?php foreach ($slideRooms as $room): ?>
                                <?php $roomImage = !empty($room['image']) ? $room['image'] : 'https://images.unsplash.com/photo-1560448070-c85a4b18525e?auto=format&fit=crop&w=1600&q=80'; ?>
                                <div class="col-md-4">
                                    <article class="room-card rounded-4 overflow-hidden shadow-lg bg-black bg-opacity-60 border border-white border-opacity-10">
                                        <div class="room-image" style="background-image:url('<?= $roomImage; ?>');"></div>
                                        <div class="p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h3 class="h5 text-white mb-0"><?= $room['name']; ?></h3>
                                                <span class="badge bg-gold text-dark">MT <?= number_format($room['price'], 0, ',', '.'); ?> / noite</span>
                                            </div>
                                            <p class="text-muted small mb-3"><?= $room['description']; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="stars text-gold">
                                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <a href="<?= base_url('reservar'); ?>" class="btn btn-outline-light btn-sm reserve-action">Reservar</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#homeRoomCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeRoomCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
    </div>
</section>

<section id="gallery" class="section py-7">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="eyebrow text-gold">Galeria de experiências</span>
            <h2 class="fw-bold">Imagens que inspiram sua estadia premium</h2>
        </div>
        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-5 overflow-hidden shadow-lg">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Spa luxo">
                    <div class="carousel-caption d-none d-md-block text-start">
                        <h5>Spa exclusivo</h5>
                        <p>Relaxamento total em ambientes de alto padrão.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Piscina premium">
                    <div class="carousel-caption d-none d-md-block text-start">
                        <h5>Piscina infinita</h5>
                        <p>Viva o cenário perfeito ao entardecer.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1471115853179-bb1d604434e0?auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Restaurante gourmet">
                    <div class="carousel-caption d-none d-md-block text-start">
                        <h5>Restaurante gourmet</h5>
                        <p>Experiências gastronômicas refinadas.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<section id="about" class="section py-7">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-card rounded-4 shadow-glass p-5 bg-black bg-opacity-70 border border-white border-opacity-10">
                    <span class="eyebrow text-gold">Sobre nós</span>
                    <h2 class="fw-bold">A excelência em hospitalidade que redefine estadias</h2>
                    <p class="text-muted">RoyaleHotel entrega conforto sofisticado com serviços personalizados, design contemporâneo e experiências premium para cada hóspede.</p>
                    <ul class="text-muted mb-0">
                        <li class="mb-2"><i class="fas fa-check-circle text-gold me-2"></i> Suite de luxo e serviço 24h</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-gold me-2"></i> Ambiente exclusivo e moderno</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-gold me-2"></i> Reservas ágeis com suporte dedicado</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-12">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80" class="img-fluid rounded-4 shadow-lg" alt="Hotel elegante">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow-lg" alt="Suíte premium">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow-lg" alt="Experiência gastronômica">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="section bg-dark text-white py-7">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="eyebrow text-gold">Serviços premium</span>
            <h2 class="fw-bold">Tudo que você espera de uma experiência 5 estrelas</h2>
        </div>
        <div class="row g-4">
            <?php $services = [
                ['icon' => 'wifi', 'title' => 'Wi-Fi Premium', 'desc' => 'Conexão rápida e estável para seu trabalho e lazer.'],
                ['icon' => 'swimming-pool', 'title' => 'Piscina', 'desc' => 'Áreas de lazer com ambientes exclusivos.'],
                ['icon' => 'utensils', 'title' => 'Restaurante', 'desc' => 'Gastronomia requintada com chefs internacionais.'],
                ['icon' => 'spa', 'title' => 'Spa', 'desc' => 'Tratamentos relaxantes e cuidados personalizados.'],
                ['icon' => 'dumbbell', 'title' => 'Academia', 'desc' => 'Espaço fitness equipado e moderno.'],
                ['icon' => 'shuttle-van', 'title' => 'Transporte', 'desc' => 'Serviço de transfer premium 24h.']
            ];
            foreach ($services as $service): ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card rounded-4 shadow-lg p-4 text-center bg-black bg-opacity-60 border border-white border-opacity-10">
                    <div class="service-icon mb-3"><i class="fas fa-<?= $service['icon']; ?> fa-2x text-gold"></i></div>
                    <h5 class="text-white mb-2"><?= $service['title']; ?></h5>
                    <p class="text-muted mb-0"><?= $service['desc']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="testimonials" class="section py-7">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="eyebrow text-gold">Depoimentos</span>
            <h2 class="fw-bold">O que nossos hóspedes falam</h2>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($reviews as $review): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="testimonial-card rounded-4 shadow-lg p-4 bg-black bg-opacity-70 border border-white border-opacity-10">
                    <div class="d-flex align-items-center mb-3 gap-3">
                        <img src="<?= $review['photo']; ?>" class="rounded-circle" width="60" height="60" alt="<?= $review['name']; ?>">
                        <div>
                            <strong class="text-white"><?= $review['name']; ?></strong>
                            <div class="text-gold small"><i class="fas fa-star"></i> <?= $review['rating']; ?>.0</div>
                        </div>
                    </div>
                    <p class="text-muted">"<?= $review['comment']; ?>"</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="stats" class="section bg-light py-7">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="stat-card rounded-4 shadow-sm p-4 bg-white">
                    <h3 class="display-6 text-gold">12K+</h3>
                    <p class="mb-0 text-muted">Hóspedes satisfeitos</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card rounded-4 shadow-sm p-4 bg-white">
                    <h3 class="display-6 text-gold">58</h3>
                    <p class="mb-0 text-muted">Quartos disponíveis</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card rounded-4 shadow-sm p-4 bg-white">
                    <h3 class="display-6 text-gold">24</h3>
                    <p class="mb-0 text-muted">Hotéis parceiros</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card rounded-4 shadow-sm p-4 bg-white">
                    <h3 class="display-6 text-gold">9.4M</h3>
                    <p class="mb-0 text-muted">Reservas realizadas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="call-to-action" class="section py-7 text-white" style="background-image:url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1600&q=80'); background-size:cover; background-position:center;">
    <div class="overlay-dark"></div>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold">Reserve agora e viva uma experiência inesquecível.</h2>
                <p class="lead text-muted mb-4">Ambientes exclusivos, serviços premium e total privacidade em cada detalhe.</p>
                <a href="<?= base_url('reservar'); ?>" class="btn btn-gold btn-lg px-5">Fazer Reserva</a>
            </div>
        </div>
    </div>
</section>

<footer id="contact" class="footer py-5 bg-black text-white">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h5 class="text-gold">RoyaleHotel</h5>
                <p class="text-muted">Sistema de reservas premium com design moderno e funcionamento completo em JSON.</p>
            </div>
            <div class="col-md-3">
                <h6>Links rápidos</h6>
                <ul class="list-unstyled text-muted">
                    <li><a href="#home">Home</a></li>
                    <li><a href="<?= base_url('quartos'); ?>">Quartos</a></li>
                    <li><a href="<?= base_url('consultar'); ?>">Consultar Reserva</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Contacto</h6>
                <p class="text-muted mb-1">Lisboa, Portugal</p>
                <p class="text-muted">contato@royalehotel.com</p>
                <p class="text-muted">+351 21 000 000</p>
            </div>
            <div class="col-md-2">
                <h6>Newsletter</h6>
                <p class="text-muted small">Receba ofertas exclusivas diretamente no seu email.</p>
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-sm bg-dark text-white border-0" placeholder="Seu email">
                    <button class="btn btn-gold btn-sm" type="button"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        <div class="text-center text-muted mt-4">&copy; <?= date('Y'); ?> RoyaleHotel. Todos os direitos reservados.</div>
    </div>
</footer>
