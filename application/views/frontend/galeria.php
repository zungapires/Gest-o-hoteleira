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
        background-image: linear-gradient(rgba(26, 26, 26, 0.55), rgba(26, 26, 26, 0.55)), url('https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=1650&q=80');
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
    }

    .hero-section p {
        color: #ddd;
        font-size: 1.1rem;
        max-width: 760px;
        margin: 0 auto;
    }

    .gallery-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .filter-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 50px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: white;
        color: var(--dark);
        border: 2px solid var(--primary);
        padding: 10px 25px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: var(--primary);
        color: white;
    }

    .filter-btn:hover {
        background: var(--primary);
        color: white;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        cursor: pointer;
        aspect-ratio: 1;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .gallery-item:hover {
        box-shadow: 0 8px 20px rgba(201, 169, 97, 0.2);
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .overlay-content {
        text-align: center;
        color: white;
    }

    .overlay-content h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .overlay-content p {
        font-size: 0.9rem;
        color: #ddd;
    }

    .gallery-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 1;
    }

    .gallery-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 900px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .modal-image {
        width: 100%;
        border-radius: 8px;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 40px;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        cursor: pointer;
        background: rgba(0,0,0,0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(0,0,0,0.8);
    }

    .modal-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 2rem;
        cursor: pointer;
        background: rgba(0,0,0,0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;
    }

    .modal-nav:hover {
        background: rgba(0,0,0,0.8);
    }

    .modal-prev {
        left: 20px;
    }

    .modal-next {
        right: 20px;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .stats-section {
        background: white;
        padding: 40px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 60px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .stat-item h4 {
        color: var(--primary);
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .stat-item p {
        color: #666;
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .modal-nav {
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
        }
    }
</style>

<div class="hero-section">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Galeria de Imagens</h1>
        <p style="font-size: 1.1rem; color: #ddd;">Conheça os ambientes de luxo do nosso hotel</p>
    </div>
</div>

<div class="gallery-container">
    <!-- Statistics -->
    <div class="stats-section">
        <h3 style="color: var(--dark);">Nossos Números</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <h4>50+</h4>
                <p>Imagens</p>
            </div>
            <div class="stat-item">
                <h4>10</h4>
                <p>Áreas</p>
            </div>
            <div class="stat-item">
                <h4>8</h4>
                <p>Categorias</p>
            </div>
            <div class="stat-item">
                <h4>4K</h4>
                <p>Qualidade</p>
            </div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="filter-buttons">
        <button class="filter-btn active" onclick="filterGallery('all')">Todos</button>
        <button class="filter-btn" onclick="filterGallery('quartos')">Quartos</button>
        <button class="filter-btn" onclick="filterGallery('comum')">Áreas Comuns</button>
        <button class="filter-btn" onclick="filterGallery('restaurant')">Restaurante</button>
        <button class="filter-btn" onclick="filterGallery('spa')">Spa & Wellness</button>
        <button class="filter-btn" onclick="filterGallery('eventos')">Eventos</button>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid" id="galleryGrid">
        <!-- Quartos -->
        <div class="gallery-item" data-category="quartos" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=500&q=60" alt="Suíte Presidencial">
            <span class="gallery-tag">Suíte Presidencial</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Suíte Presidencial</h3>
                    <p>Luxo e conforto supremo</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="quartos" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=500&q=60" alt="Quarto Deluxe">
            <span class="gallery-tag">Quarto Deluxe</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Quarto Deluxe</h3>
                    <p>Elegância e conforto</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="quartos" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=500&q=60" alt="Suíte Romântica">
            <span class="gallery-tag">Suíte Romântica</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Suíte Romântica</h3>
                    <p>Perfeita para casais</p>
                </div>
            </div>
        </div>

        <!-- Áreas Comuns -->
        <div class="gallery-item" data-category="comum" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1566665556112-652301e56e81?auto=format&fit=crop&w=500&q=60" alt="Lobby Principal">
            <span class="gallery-tag">Lobby Principal</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Lobby Principal</h3>
                    <p>Entrada de boas-vindas</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="comum" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1578683078519-a680e9f99a2e?auto=format&fit=crop&w=500&q=60" alt="Piscina Exterior">
            <span class="gallery-tag">Piscina Exterior</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Piscina Exterior</h3>
                    <p>Relaxamento ao ar livre</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="comum" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1521206900456-8387d1419bbe?auto=format&fit=crop&w=500&q=60" alt="Jardim Interno">
            <span class="gallery-tag">Jardim Interno</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Jardim Interno</h3>
                    <p>Natureza em harmonia</p>
                </div>
            </div>
        </div>

        <!-- Restaurante -->
        <div class="gallery-item" data-category="restaurant" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1504674900769-a5d7a5f8c4e0?auto=format&fit=crop&w=500&q=60" alt="Restaurante Gourmet">
            <span class="gallery-tag">Restaurante</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Restaurante Gourmet</h3>
                    <p>Gastronomia de classe mundial</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="restaurant" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1503674900769-a5d7a5f8c1f0?auto=format&fit=crop&w=500&q=60" alt="Bar Lounge">
            <span class="gallery-tag">Bar Lounge</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Bar Lounge</h3>
                    <p>Drinks e ambientação premium</p>
                </div>
            </div>
        </div>

        <!-- Spa & Wellness -->
        <div class="gallery-item" data-category="spa" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1498940336406-bdf4e68d1eb8?auto=format&fit=crop&w=500&q=60" alt="Spa Completo">
            <span class="gallery-tag">Spa Completo</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Spa Completo</h3>
                    <p>Bem-estar e relaxamento</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="spa" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=500&q=60" alt="Sauna e Vapor">
            <span class="gallery-tag">Sauna & Vapor</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Sauna e Vapor</h3>
                    <p>Experiência de purificação</p>
                </div>
            </div>
        </div>

        <!-- Eventos -->
        <div class="gallery-item" data-category="eventos" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1519167758481-83f19106457f?auto=format&fit=crop&w=500&q=60" alt="Sala de Conferências">
            <span class="gallery-tag">Conferências</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Sala de Conferências</h3>
                    <p>Equipada com tecnologia 4K</p>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-category="eventos" onclick="openModal(this)">
            <img src="https://images.unsplash.com/photo-1465632066175-c51bbf1dc769?auto=format&fit=crop&w=500&q=60" alt="Banquete">
            <span class="gallery-tag">Banquete</span>
            <div class="gallery-overlay">
                <div class="overlay-content">
                    <h3>Salão de Banquete</h3>
                    <p>Espaço elegante para eventos</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="gallery-modal">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <span class="modal-nav modal-prev" onclick="prevImage()">&#10094;</span>
    <div class="modal-content">
        <img class="modal-image" id="modalImage" src="">
    </div>
    <span class="modal-nav modal-next" onclick="nextImage()">&#10095;</span>
</div>

<script>
    let currentImageIndex = 0;

    function filterGallery(category) {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Filter items
        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function openModal(element) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const img = element.querySelector('img');
        
        modalImage.src = img.src;
        modal.style.display = 'block';

        // Store current index for navigation
        const allVisible = Array.from(document.querySelectorAll('.gallery-item')).filter(item => item.style.display !== 'none');
        currentImageIndex = allVisible.indexOf(element);
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    function prevImage() {
        const allVisible = Array.from(document.querySelectorAll('.gallery-item')).filter(item => item.style.display !== 'none');
        currentImageIndex = (currentImageIndex - 1 + allVisible.length) % allVisible.length;
        openModal(allVisible[currentImageIndex]);
    }

    function nextImage() {
        const allVisible = Array.from(document.querySelectorAll('.gallery-item')).filter(item => item.style.display !== 'none');
        currentImageIndex = (currentImageIndex + 1) % allVisible.length;
        openModal(allVisible[currentImageIndex]);
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('imageModal').style.display === 'block') {
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'Escape') closeModal();
        }
    });
</script>

<?php $this->load->view('layouts/footer'); ?>
