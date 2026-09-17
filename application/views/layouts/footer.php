</div>
<footer class="footer pt-5 pb-4">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <a href="<?= base_url(); ?>" class="footer-brand d-flex align-items-center gap-3 mb-3">
                    <span class="brand-mark"><i class="fas fa-crown"></i></span>
                    <div>
                        <div class="brand-name">RoyaleHotel</div>
                        <small class="text-muted">Gestão premium para hotelaria</small>
                    </div>
                </a>
                <p class="text-muted">Solução de reservas e gestão para hotéis de luxo. Interface elegante, painel completo e controle centralizado para operações comerciais globais.</p>
                <div class="social-links mt-4">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <h5>Produtos</h5>
                <ul class="footer-list list-unstyled mt-3">
                    <li><a href="<?= base_url('quartos'); ?>">Quartos</a></li>
                    <li><a href="<?= base_url('reservar'); ?>">Reservas</a></li>
                    <li><a href="<?= base_url('contacto'); ?>">Contacto</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <h5>Serviços</h5>
                <ul class="footer-list list-unstyled mt-3">
                    <li><a href="<?= base_url('servicos'); ?>">Serviços & Lazer</a></li>
                    <li><a href="<?= base_url('galeria'); ?>">Galeria</a></li>
                    <li><a href="<?= base_url('consultar'); ?>">Consultar Reserva</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Contato</h5>
                <ul class="footer-list list-unstyled mt-3">
                    <li><a href="tel:+123456789">+123 456 789</a></li>
                    <li><a href="mailto:suporte@royalehotel.com">suporte@royalehotel.com</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-4 pt-4 border-top border-secondary border-opacity-10 text-center">
            <small class="text-muted">© <?= date('Y'); ?> RoyaleHotel. Todos os direitos reservados.</small>
        </div>
    </div>
</footer>

<div class="modal fade" id="reserveOptionModal" tabindex="-1" aria-labelledby="reserveOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="reserveOptionModalLabel">Como deseja continuar?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Escolha a forma de reserva: com conta ou como visitante.</p>
                <div class="d-grid gap-3">
                    <a href="<?= base_url('login'); ?>" class="btn btn-outline-light">Entrar na Minha Conta</a>
                    <a href="<?= base_url('reservar'); ?>" class="btn btn-gold">Reservar como Visitante</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.appBaseUrl = '<?= rtrim(base_url(), '/') . '/'; ?>';
    window.isAuthenticated = <?= isset($user) && $user ? 'true' : 'false'; ?>;
    window.currentUserEmail = <?= isset($user) && !empty($user['email']) ? json_encode($user['email']) : 'null'; ?>;
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
</body>
</html>
