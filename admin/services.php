<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
check_admin_session();

$message = '';

// Handle Add/Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service'])) {
        $name = $_POST['name'];
        $slug = slugify($name); // Auto-generate slug
        $description = $_POST['description'];

        try {
            $stmt = $pdo->prepare("INSERT INTO services (name, slug, description) VALUES (?, ?, ?)");
            $stmt->execute([$name, $slug, $description]);
            $message = "Servizio aggiunto con successo!";
        } catch (PDOException $e) {
            $message = "Errore: " . $e->getMessage();
        }
    } elseif (isset($_POST['delete_service'])) {
        $id = $_POST['service_id'];
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Servizio eliminato.";
    }
}

$services = get_all_services($pdo);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Gestione Servizi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php include 'navbar.php'; // We'll create a simple navbar include or just revert to sidebar for now ?>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Dashboard</a>
        <h2>Gestione Servizi</h2>

        <?php if ($message): ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header">Aggiungi Nuovo Servizio</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Nome Servizio</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Descrizione Breve</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" name="add_service" class="btn btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>

        <table class="table table-striped table-bordered bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $svc): ?>
                    <tr>
                        <td>
                            <?= $svc['id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($svc['name']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($svc['slug']) ?>
                        </td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Sei sicuro?');">
                                <input type="hidden" name="service_id" value="<?= $svc['id'] ?>">
                                <button type="submit" name="delete_service" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>