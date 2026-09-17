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

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 60px;
    }

    .contact-info {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .contact-item {
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
    }

    .contact-item-icon {
        font-size: 1.5rem;
        color: var(--primary);
        min-width: 40px;
        text-align: center;
    }

    .contact-item-content h3 {
        color: var(--dark);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .contact-item-content p {
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    .contact-form {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark);
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        background: #b8944d;
        transform: scale(1.02);
    }

    .map-section {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 400px;
        margin-bottom: 60px;
    }

    .social-links {
        text-align: center;
        margin: 60px 0;
    }

    .social-links h3 {
        color: var(--dark);
        margin-bottom: 25px;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(201, 169, 97, 0.3);
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .hero-section h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="hero-section">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Contacte-Nos</h1>
        <p style="font-size: 1.1rem; color: #ddd;">Estamos aqui para ajudar com qualquer dúvida</p>
    </div>
</div>

<div class="contact-container">
    <div class="contact-grid">
        <!-- Contact Information -->
        <div class="contact-info">
            <h2 style="color: var(--dark); margin-bottom: 30px; font-weight: 700;">Informações de Contacto</h2>

            <div class="contact-item">
                <div class="contact-item-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Localização</h3>
                    <p>Av. Mao Tse Tung, 1000<br>Maputo, Moçambique</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Telefone</h3>
                    <p>+258 21 309 156<br>+258 84 123 4567<br>Seg-Dom: 24 horas</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Email</h3>
                    <p>reservas@hoteluxo.com<br>atendimento@hoteluxo.com<br>suporte@hoteluxo.com</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="contact-item-content">
                    <h3>Horário de Funcionamento</h3>
                    <p>Check-in: 14:00<br>Check-out: 12:00<br>Recepção 24 horas disponível</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h2 style="color: var(--dark); margin-bottom: 30px; font-weight: 700;">Envie uma Mensagem</h2>

            <form id="contactForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="tel" id="phone" name="phone" placeholder="+258 (84) 1xx xxxx">
                </div>

                <div class="form-group">
                    <label for="subject">Assunto</label>
                    <select id="subject" name="subject" required>
                        <option value="">Selecione um assunto...</option>
                        <option value="reserva">Informações sobre Reserva</option>
                        <option value="eventos">Eventos e Conferências</option>
                        <option value="servicos">Serviços Especiais</option>
                        <option value="reclamacao">Reclamação ou Sugestão</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Enviar Mensagem
                </button>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <iframe 
            width="100%" 
            height="100%" 
            style="border:0" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.1974580293406!2d-46.65789!3d-23.56164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0480b1%3A0x9ff52c88e3e2908!2sAv.%20Paulista%2C%201000%20-%20S%C3%A3o%20Paulo%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1234567890" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

    <!-- Social Links -->
    <div class="social-links">
        <h3>Siga-nos nas Redes Sociais</h3>
        <div class="social-icons">
            <a class="social-icon" href="https://facebook.com" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="social-icon" href="https://instagram.com" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="social-icon" href="https://twitter.com" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="social-icon" href="https://linkedin.com" title="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="social-icon" href="https://youtube.com" title="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>
</div>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Mensagem Enviada',
            text: 'Obrigado por entrar em contacto! Responderemos em breve.',
            confirmButtonColor: '#c9a961'
        });
        this.reset();
    });
</script>

<?php $this->load->view('layouts/footer'); ?>
