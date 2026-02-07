<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
check_admin_session();

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status'])) {
        $id = $_POST['lead_id'];
        $status = $_POST['status'];
        $stmt = $pdo->prepare("UPDATE leads SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    } elseif (isset($_POST['update_notes'])) {
        $id = $_POST['lead_id'];
        $notes = $_POST['notes'];
        $stmt = $pdo->prepare("UPDATE leads SET notes = ? WHERE id = ?");
        $stmt->execute([$notes, $id]);
    } elseif (isset($_POST['delete_lead'])) {
        $id = $_POST['lead_id'];
        $stmt = $pdo->prepare("DELETE FROM leads WHERE id = ?");
        $stmt->execute([$id]);
    }
}

// Fetch Leads with Joins
$sql = "SELECT l.*, s.name as service_name, z.name as zone_name 
        FROM leads l 
        LEFT JOIN services s ON l.service_id = s.id 
        LEFT JOIN zones z ON l.zone_id = z.id 
        ORDER BY l.created_at DESC";
$leads = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Gestione Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-nuovo {
            background-color: #d4edda;
        }

        .status-contattato {
            background-color: #fff3cd;
        }

        .status-chiuso {
            background-color: #d1ecf1;
        }

        .status-cancellato {
            background-color: #f8d7da;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Dashboard</a>
        <h2>Gestione Leads</h2>

        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Email / Telefono</th>
                    <th>Servizio / Zona</th>
                    <th>Messaggio</th>
                    <th>Stato</th>
                    <th>Note</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead): ?>
                    <tr class="status-<?= strtolower($lead['status']) ?>">
                        <td>
                            <?= date('d/m/Y H:i', strtotime($lead['created_at'])) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($lead['name']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($lead['email']) ?><br>
                            <a href="tel:<?= htmlspecialchars($lead['phone']) ?>">
                                <?= htmlspecialchars($lead['phone']) ?>
                            </a>
                        </td>
                        <td>
                            <?= htmlspecialchars($lead['service_name'] ?? 'Gen.') ?><br>
                            <small>
                                <?= htmlspecialchars($lead['zone_name'] ?? '-') ?>
                            </small>
                        </td>
                        <td><small>
                                <?= nl2br(htmlspecialchars($lead['message'])) ?>
                            </small></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="Nuovo" <?= $lead['status'] == 'Nuovo' ? 'selected' : '' ?>>Nuovo</option>
                                    <option value="Contattato" <?= $lead['status'] == 'Contattato' ? 'selected' : '' ?>
                                        >Contattato</option>
                                    <option value="In Corso" <?= $lead['status'] == 'In Corso' ? 'selected' : '' ?>>In Corso
                                    </option>
                                    <option value="Chiuso" <?= $lead['status'] == 'Chiuso' ? 'selected' : '' ?>>Chiuso</option>
                                    <option value="Cancellato" <?= $lead['status'] == 'Cancellato' ? 'selected' : '' ?>
                                        >Cancellato</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                                <textarea name="notes" class="form-control form-control-sm" rows="2"
                                    onblur="this.form.submit()"><?= htmlspecialchars($lead['notes']) ?></textarea>
                                <input type="hidden" name="update_notes" value="1">
                            </form>
                        </td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Eliminare questo lead?');">
                                <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                                <button type="submit" name="delete_lead" class="btn btn-danger btn-sm">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>