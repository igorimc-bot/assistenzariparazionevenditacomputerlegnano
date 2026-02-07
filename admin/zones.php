<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
check_admin_session();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_zone'])) {
        $name = $_POST['name'];
        $slug = slugify($name);
        $type = $_POST['type'];
        $parent_city = $_POST['parent_city'] ?: null;

        try {
            $stmt = $pdo->prepare("INSERT INTO zones (name, slug, type, parent_city) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $type, $parent_city]);
            $message = "Zona aggiunta con successo!";
        } catch (PDOException $e) {
            $message = "Errore: " . $e->getMessage();
        }
    } elseif (isset($_POST['delete_zone'])) {
        $id = $_POST['zone_id'];
        $stmt = $pdo->prepare("DELETE FROM zones WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Zona eliminata.";
    }
}

$zones = get_all_zones($pdo);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Gestione Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Dashboard</a>
        <h2>Gestione Zone</h2>

        <?php if ($message): ?>
            <div class="alert alert-info">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header">Aggiungi Nuova Zona</div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Nome Zona/Comune</label>
                            <input type="text" name="name" class="form-control" required placeholder="Es. Legnano">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Tipo</label>
                            <select name="type" class="form-select">
                                <option value="Comune">Comune</option>
                                <option value="Quartiere">Quartiere</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Città Genitore (opzionale)</label>
                            <input type="text" name="parent_city" class="form-control"
                                placeholder="Es. Milano (per quartieri)">
                        </div>
                    </div>
                    <button type="submit" name="add_zone" class="btn btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>

        <table class="table table-striped table-bordered bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Tipo</th>
                    <th>Parent</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zones as $zone): ?>
                    <tr>
                        <td>
                            <?= $zone['id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($zone['name']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($zone['slug']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($zone['type']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($zone['parent_city']) ?>
                        </td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Sei sicuro?');">
                                <input type="hidden" name="zone_id" value="<?= $zone['id'] ?>">
                                <button type="submit" name="delete_zone" class="btn btn-danger btn-sm">Elimina</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>