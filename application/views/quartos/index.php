<?php $this->load->view('layouts/header'); ?>
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
        background-image: linear-gradient(rgba(26, 26, 26, 0.55), rgba(26, 26, 26, 0.55)), url('https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1650&q=80');
        background-size: cover;
        background-position: center;
        min-height: 55vh;
        color: white;
        padding: 80px 0;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .hero-section p {
        font-size: 1.2rem;
        color: #ddd;
        max-width: 760px;
        margin: 0 auto;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: #ddd;
    }

    .room-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        max-width: 100%;
    }

    .room-card:hover {
        box-shadow: 0 8px 20px rgba(201, 169, 97, 0.2);
        transform: translateY(-5px);
    }

    .room-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        position: relative;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .carousel-item {
        transition: transform 0.6s ease-in-out;
    }
    .carousel-indicators [data-bs-target] {
        background-color: rgba(201, 169, 97, 0.8);
    }

    .room-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary);
        color: white;
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .room-content {
        padding: 18px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .room-type {
        color: var(--primary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .room-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .room-description {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 12px;
        line-height: 1.4;
        flex-grow: 1;
    }

    .room-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .room-capacity {
        display: flex;
        align-items: center;
        color: #666;
        font-size: 0.9rem;
    }

    .room-capacity i {
        margin-right: 6px;
        color: var(--primary);
    }

    .room-price {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary);
    }

    .room-price small {
        font-size: 0.6rem;
        display: block;
        color: #999;
        font-weight: 400;
    }

    .btn-book {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-book:hover {
        background: #b8944d;
        transform: scale(1.02);
    }

    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 40px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .filter-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
    }

    .filter-item label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    .filter-item select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .stats-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-box {
        background: white;
        padding: 25px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .stat-label {
        color: #666;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .container-fluid-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .filter-group {
            flex-direction: column;
        }

        .filter-item {
            width: 100%;
        }

        .filter-item select {
            width: 100%;
        }
    }
</style>

<div class="hero-section">
    <div class="container-fluid-custom">
        <h1>Nossos Quartos</h1>
        <p>Escolha entre nossas suítes e quartos luxuosos</p>
    </div>
</div>

<div class="container-fluid-custom" style="padding: 60px 20px;">
    <!-- Statistics -->
    <div class="stats-section">
        <div class="stat-box">
            <div class="stat-number"><?php echo count($rooms ?? []); ?></div>
            <div class="stat-label">Quartos Disponíveis</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">10</div>
            <div class="stat-label">Categorias</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">5★</div>
            <div class="stat-label">Classificação</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">24h</div>
            <div class="stat-label">Atendimento</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-group">
            <div class="filter-item">
                <label for="typeFilter">Tipo de Quarto</label>
                <select id="typeFilter">
                    <option value="">Todos os tipos</option>
                    <option value="Suíte Luxo">Suíte Luxo</option>
                    <option value="Quarto Premium">Quarto Premium</option>
                    <option value="Quarto Conforto">Quarto Conforto</option>
                </select>
            </div>
            <div class="filter-item">
                <label for="capacityFilter">Capacidade</label>
                <select id="capacityFilter">
                    <option value="">Qualquer capacidade</option>
                    <option value="2">2 Pessoas</option>
                    <option value="3">3 Pessoas</option>
                    <option value="4">4 Pessoas</option>
                </select>
            </div>
            <div class="filter-item">
                <label for="priceFilter">Faixa de Preço</label>
                <select id="priceFilter">
                    <option value="">Qualquer preço</option>
                    <option value="200">Até MT 200</option>
                    <option value="300">MT 200 - MT 300</option>
                    <option value="400">MT 300 - MT 400</option>
                    <option value="999">Acima de MT 400</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Rooms Carousel -->
    <?php
        $roomImageDefaults = [
            'Suíte Imperial' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1600&q=80',
            'Quarto Executive' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80',
            'Suíte Presidencial' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1600&q=80',
            'Quarto Deluxe' => 'https://images.unsplash.com/photo-1519985176271-adb1088fa94c?auto=format&fit=crop&w=1600&q=80',
            'Quarto Standard' => 'https://images.unsplash.com/photo-1560448070-c85a4b18525e?auto=format&fit=crop&w=1600&q=80',
            'Suíte Vista Mar' => 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1600&q=80',
            'Quarto Casal Plus' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1600&q=80',
            'Quarto Triplo' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=1600&q=80',
            'Suíte Romântica' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1600&q=80',
            'Quarto Familiar' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1600&q=80',
        ];

        if (!function_exists('getRoomImage')) {
            function getRoomImage($room, $index, $fallbacks) {
                $image = isset($room['image']) ? trim($room['image']) : '';
                if ($image && filter_var($image, FILTER_VALIDATE_URL)) {
                    return $image;
                }
                if (!empty($room['name']) && isset($fallbacks[$room['name']])) {
                    return $fallbacks[$room['name']];
                }
                $fallbacksList = array_values($fallbacks);
                return $fallbacksList[$index % count($fallbacksList)];
            }
        }

        $roomSlides = array_chunk(!empty($rooms) ? $rooms : [], 3);
    ?>

    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover">
        <div class="carousel-indicators">
            <?php foreach ($roomSlides as $slideIndex => $slideRooms): ?>
                <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="<?php echo $slideIndex; ?>" class="<?php echo $slideIndex === 0 ? 'active' : ''; ?>" aria-current="<?php echo $slideIndex === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $slideIndex + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php if (!empty($roomSlides)): ?>
                <?php foreach ($roomSlides as $slideIndex => $slideRooms): ?>
                    <div class="carousel-item <?php echo $slideIndex === 0 ? 'active' : ''; ?>">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($slideRooms as $roomIndex => $room): ?>
                                <?php $roomImage = getRoomImage($room, ($slideIndex * 3) + $roomIndex, $roomImageDefaults); ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="room-card mx-auto">
                                        <div style="position: relative;">
                                            <img src="<?php echo htmlspecialchars($roomImage); ?>" alt="<?php echo htmlspecialchars($room['name']); ?>" class="room-image">
                                            <span class="room-badge"><?php echo htmlspecialchars($room['type']); ?></span>
                                        </div>
                                        <div class="room-content">
                                            <div class="room-type"><?php echo htmlspecialchars($room['type']); ?></div>
                                            <h3 class="room-name"><?php echo htmlspecialchars($room['name']); ?></h3>
                                            <p class="room-description"><?php echo htmlspecialchars($room['description']); ?></p>
                                            <div class="room-details">
                                                <div class="room-capacity">
                                                    <i class="fas fa-users"></i>
                                                    <?php echo htmlspecialchars($room['capacity']); ?> pessoa(s)
                                                </div>
                                                <div class="room-price">
                                                    MT <?php echo number_format($room['price'], 0, ',', '.'); ?>
                                                    <small>por noite</small>
                                                </div>
                                            </div>
                                            <button class="btn-book" onclick="goToRoom(<?php echo intval($room['id']); ?>)">
                                                <i class="fas fa-calendar-alt"></i> Reservar Agora
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="alert alert-info text-center">Nenhum quarto disponível no momento.</div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($rooms) && count($rooms) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        <?php endif; ?>
    </div>
</div>

<script>
    function goToRoom(roomId) {
        window.location.href = '<?php echo base_url('reservar'); ?>';
    }

    // Filter functionality
    document.getElementById('typeFilter').addEventListener('change', filterRooms);
    document.getElementById('capacityFilter').addEventListener('change', filterRooms);
    document.getElementById('priceFilter').addEventListener('change', filterRooms);

    function filterRooms() {
        const typeFilter = document.getElementById('typeFilter').value;
        const capacityFilter = document.getElementById('capacityFilter').value;
        const priceFilter = document.getElementById('priceFilter').value;

        const items = document.querySelectorAll('#roomCarousel .carousel-item');
        let activeIndex = -1;

        items.forEach((item, index) => {
            const card = item.querySelector('.room-card');
            if (!card) {
                item.style.display = 'block';
                return;
            }

            const type = card.querySelector('.room-type').textContent.trim();
            const capacity = card.querySelector('.room-capacity').textContent;
            const price = parseInt(card.querySelector('.room-price').textContent.match(/\d+/)[0]);

            let show = true;
            if (typeFilter && !type.includes(typeFilter)) show = false;
            if (capacityFilter && !capacity.includes(capacityFilter)) show = false;
            if (priceFilter) {
                const maxPrice = parseInt(priceFilter);
                if (price > maxPrice) show = false;
            }

            item.style.display = show ? 'block' : 'none';
            if (show && activeIndex === -1) {
                activeIndex = index;
            }
        });

        const carousel = bootstrap.Carousel.getInstance(document.getElementById('roomCarousel')) || new bootstrap.Carousel(document.getElementById('roomCarousel'));
        if (activeIndex > 0) {
            carousel.to(activeIndex);
        }
    }
</script>

<?php $this->load->view('layouts/footer'); ?>
