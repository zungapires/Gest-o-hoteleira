<div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-white">Gestão de Quartos</h1>
        <p class="text-muted mb-0">Adicione, edite ou remova quartos do inventário.</p>
    </div>
    <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#roomModal">Adicionar Quarto</button>
</div>
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-black bg-opacity-80 rounded-4 shadow-sm p-3 border border-white border-opacity-10">
            <div class="text-muted">Disponíveis</div>
            <div class="h3 text-white" id="roomCountAvailable"><?= count(array_filter($rooms, fn($room) => $room['status'] === 'available')); ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-black bg-opacity-80 rounded-4 shadow-sm p-3 border border-white border-opacity-10">
            <div class="text-muted">Reservados</div>
            <div class="h3 text-white" id="roomCountReserved"><?= count(array_filter($rooms, fn($room) => $room['status'] === 'reserved')); ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-black bg-opacity-80 rounded-4 shadow-sm p-3 border border-white border-opacity-10">
            <div class="text-muted">Indisponíveis</div>
            <div class="h3 text-white" id="roomCountUnavailable"><?= count(array_filter($rooms, fn($room) => $room['status'] === 'unavailable')); ?></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card bg-black bg-opacity-80 rounded-4 shadow-sm p-3 border border-white border-opacity-10">
            <div class="text-muted">Total</div>
            <div class="h3 text-white"><?= count($rooms); ?></div>
        </div>
    </div>
</div>
<div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10 mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label text-muted" for="roomStatusFilter">Status</label>
            <select id="roomStatusFilter" class="form-select bg-dark text-white">
                <option value="">Todos</option>
                <option value="available">Disponível</option>
                <option value="reserved">Reservado</option>
                <option value="unavailable">Indisponível</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted" for="roomTypeFilter">Tipo</label>
            <input id="roomTypeFilter" class="form-control bg-dark text-white" placeholder="Filtrar por tipo">
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted" for="roomNumberFilter">Número</label>
            <input id="roomNumberFilter" class="form-control bg-dark text-white" placeholder="Filtrar por número">
        </div>
    </div>
</div>
<div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle" id="roomsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                    <th>Capacidade</th>
                    <th>Status</th>
                    <th>Bloqueios</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room['id']; ?></td>
                    <td><?= isset($room['number']) ? htmlspecialchars($room['number']) : '—'; ?></td>
                    <td><?= $room['name']; ?></td>
                    <td><?= $room['type']; ?></td>
                    <td>MT <?= number_format($room['price'], 0, ',', '.'); ?></td>
                    <td><?= $room['capacity']; ?></td>
                    <td><?= ucfirst($room['status']); ?></td>
                    <td><?= isset($room['blocked_periods']) && is_array($room['blocked_periods']) ? count($room['blocked_periods']) : 0; ?></td>
                    <td>
                        <button class="btn btn-sm btn-outline-light edit-room" data-room='<?= json_encode($room, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>Editar</button>
                        <button class="btn btn-sm btn-danger delete-room" data-id="<?= $room['id']; ?>">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="roomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white border border-white border-opacity-10 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title">Adicionar / Editar Quarto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="roomForm">
                    <input type="hidden" name="id" id="room_id">
                    <div class="row g-3">
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_number" name="number" placeholder="Número" required>
                            <label for="room_number">Número</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_name" name="name" placeholder="Nome" required>
                            <label for="room_name">Nome</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_price" name="price" placeholder="Preço" type="number" required>
                            <label for="room_price">Preço</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_capacity" name="capacity" placeholder="Capacidade" type="number" required>
                            <label for="room_capacity">Capacidade</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_type" name="type" placeholder="Tipo" required>
                            <label for="room_type">Tipo</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <select class="form-select bg-dark text-white" id="room_status" name="status" required>
                                <option value="available">Disponível</option>
                                <option value="reserved">Reservado</option>
                                <option value="unavailable">Indisponível</option>
                            </select>
                            <label for="room_status">Status</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input class="form-control bg-dark text-white" id="room_image" name="image" placeholder="URL da imagem" required>
                            <label for="room_image">URL da imagem</label>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="bg-white bg-opacity-10 rounded-4 p-3">
                                <h6 class="text-white mb-3">Bloquear período para manutenção</h6>
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4 form-floating">
                                        <input type="date" class="form-control bg-dark text-white" id="block_start_date" placeholder="Data de início">
                                        <label for="block_start_date">Início</label>
                                    </div>
                                    <div class="col-md-4 form-floating">
                                        <input type="date" class="form-control bg-dark text-white" id="block_end_date" placeholder="Data de fim">
                                        <label for="block_end_date">Fim</label>
                                    </div>
                                    <div class="col-md-4 form-floating">
                                        <input type="text" class="form-control bg-dark text-white" id="block_note" placeholder="Motivo / nota">
                                        <label for="block_note">Motivo</label>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-outline-light" id="addBlockPeriod">Adicionar bloqueio</button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div id="blockedPeriodsList" class="text-white"></div>
                                </div>
                                <textarea id="blocked_periods" name="blocked_periods" class="d-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12 form-floating">
                            <textarea class="form-control bg-dark text-white" id="room_description" name="description" placeholder="Descrição" style="height: 120px" required></textarea>
                            <label for="room_description">Descrição</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-gold" id="saveRoom">Salvar Quarto</button>
            </div>
        </div>
    </div>
</div>
</main>
