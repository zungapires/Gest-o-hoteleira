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

    .service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin: 60px 0;
    }

    .service-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        text-align: center;
        padding: 40px 25px;
    }

    .service-card:hover {
        box-shadow: 0 8px 20px rgba(201, 169, 97, 0.2);
        transform: translateY(-5px);
    }

    .service-icon {
        font-size: 3.5rem;
        color: var(--primary);
        margin-bottom: 20px;
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 15px;
    }

    .service-description {
        color: #666;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 40px 0;
    }

    .amenity-item {
        background: white;
        padding: 25px;
        border-radius: 8px;
        border-left: 4px solid var(--primary);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .amenity-item strong {
        display: block;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .container-fluid-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
</style>

<div class="hero-section">
    <div class="container-fluid-custom">
        <h1>Nossos Serviços</h1>
        <p style="font-size: 1.1rem; color: #ddd;">Comodidades de luxo para sua estadia perfeita</p>
    </div>
</div>

<div class="container-fluid-custom" style="padding: 60px 20px;">
    <!-- Main Services -->
    <h2 style="text-align: center; color: var(--dark); margin-bottom: 50px; font-weight: 700;">
        Serviços Premium
    </h2>

    <div class="service-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-spa"></i>
            </div>
            <h3 class="service-title">Spa & Wellness</h3>
            <p class="service-description">
                Relaxe em nosso spa completo com massagens terapêuticas, sauna, piscina aquecida e programas de bem-estar personalizados.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <h3 class="service-title">Restaurante Gourmet</h3>
            <p class="service-description">
                Desfrute da gastronomia de classe mundial preparada por nossos chefs renomados. Room service 24 horas disponível.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h3 class="service-title">Academia Premium</h3>
            <p class="service-description">
                Equipamentos de ponta, personal trainers certificados e aulas de yoga, pilates e cardio. Acesso 24 horas.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <h3 class="service-title">Concierge 24h</h3>
            <p class="service-description">
                Nosso dedicado time de concierge está pronto para ajudar com reservas, recomendações e qualquer necessidade especial.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-wifi"></i>
            </div>
            <h3 class="service-title">Conectividade Premium</h3>
            <p class="service-description">
                WiFi ultrarrápido 5G, salas de reuniões equipadas com tecnologia, estação de trabalho executiva disponível.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-car"></i>
            </div>
            <h3 class="service-title">Transporte Executivo</h3>
            <p class="service-description">
                Serviço de transfer com limousine, estacionamento coberto e valet parking para sua conveniência.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-events"></i>
            </div>
            <h3 class="service-title">Eventos & Conferências</h3>
            <p class="service-description">
                Salões adaptáveis, equipamento audiovisual de ponta e equipe especializada para seu evento memorável.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-child"></i>
            </div>
            <h3 class="service-title">Kids Club</h3>
            <p class="service-description">
                Área recreativa segura, atividades supervisionadas e programação divertida para as crianças durante toda a estadia.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-map"></i>
            </div>
            <h3 class="service-title">Tours & Atividades</h3>
            <p class="service-description">
                Excursões organizadas, ecoturismo, aventura e experiências culturais. Planejamos seus passeios perfeitos.
            </p>
        </div>
    </div>

    <!-- Amenities Section -->
    <h2 style="text-align: center; color: var(--dark); margin-top: 80px; margin-bottom: 50px; font-weight: 700;">
        Comodidades em Todos os Quartos
    </h2>

    <div class="amenities-grid">
        <div class="amenity-item">
            <strong>🛏️ Camas Premium</strong>
            Roupa de cama de alta qualidade com travesseiros de pena
        </div>
        <div class="amenity-item">
            <strong>🚿 Banheiro Luxury</strong>
            Produtos de higiene premium, secador e artigos de banho exclusivos
        </div>
        <div class="amenity-item">
            <strong>🖥️ Smart TV</strong>
            TV 4K com streaming Netflix, HBO e canais premium
        </div>
        <div class="amenity-item">
            <strong>❄️ Ar Condicionado</strong>
            Clima controlável e silencioso 24 horas
        </div>
        <div class="amenity-item">
            <strong>🔒 Cofre Digital</strong>
            Cofre de parede com código de segurança para seus objetos de valor
        </div>
        <div class="amenity-item">
            <strong>☕ Nespresso</strong>
            Máquina de café espresso e seleção de cápsulas gourmet
        </div>
        <div class="amenity-item">
            <strong>🌙 Cortina Blackout</strong>
            Cortinas automáticas e blackout para descanso perfeito
        </div>
        <div class="amenity-item">
            <strong>📱 Carregamento Wireless</strong>
            Carregadores rápidos e pontos USB em múltiplas localizações
        </div>
        <div class="amenity-item">
            <strong>🧹 Limpeza Diária</strong>
            Serviço de limpeza completo com turnover durante o dia
        </div>
        <div class="amenity-item">
            <strong>🎧 Sonosystem</strong>
            Sistema de som premium em toda a suíte
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
