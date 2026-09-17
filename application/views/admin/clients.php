<div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 text-white">Clientes</h1>
        <p class="text-muted mb-0">Liste e acompanhe os clientes cadastrados.</p>
    </div>
</div>
<div class="card bg-black bg-opacity-80 rounded-4 shadow-lg p-4 border border-white border-opacity-10">
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle" id="clientsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Função</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client['id']; ?></td>
                        <td><?= $client['name']; ?></td>
                        <td><?= $client['email']; ?></td>
                        <td><?= ucfirst($client['role']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</main>
