<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Super Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciamento de Super Administradores</h2>
            <a href="<?= base_url('/superadm/logout') ?>" class="btn btn-danger">Sair</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($superadmins) && is_array($superadmins)): ?>
                            <?php foreach ($superadmins as $superadmin): ?>
                                <tr>
                                    <td><strong><?= esc($superadmin['USU_CPF']) ?></strong></td>[cite: 7, 9]
                                    <td><?= esc($superadmin['USU_NOME']) ?></td>[cite: 7, 9]
                                    <td><?= esc($superadmin['USU_EMAIL']) ?></td>[cite: 7, 9]
                                    <td>
                                        <span class="badge bg-<?= $superadmin['USU_STATUS'] === 'ATIVO' ? 'success' : 'secondary' ?>">[cite: 9]
                                            <?= esc($superadmin['USU_STATUS']) ?>[cite: 9]
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Nenhum administrador encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>