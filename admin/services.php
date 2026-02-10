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
            // Get max sort_order
            $stmt = $pdo->query("SELECT MAX(sort_order) FROM services");
            $max_order = $stmt->fetchColumn();
            $sort_order = $max_order !== false ? $max_order + 1 : 0;

            $stmt = $pdo->prepare("INSERT INTO services (name, slug, description, sort_order) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $description, $sort_order]);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <style>
        .cursor-grab {
            cursor: grab;
        }

        .cursor-grab:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: 0.4;
            background-color: #f0f0f0;
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex">
        <?php include '../includes/admin_sidebar.php'; // Assuming a sidebar include exists or reusing structure ?>
        <div class="container-fluid p-4" style="margin-left: 250px;"> <!-- Adjust margin based on sidebar -->

            <!-- Temporary Sidebar shim if include doesn't exist yet, for visual consistency with index.php -->
            <?php if (!file_exists('../includes/admin_sidebar.php')): ?>
                <style>
                    .sidebar {
                        height: 100vh;
                        position: fixed;
                        top: 0;
                        left: 0;
                        padding-top: 20px;
                        width: 250px;
                        background-color: #343a40;
                        color: white;
                        z-index: 1000;
                    }

                    .sidebar a {
                        padding: 10px 15px;
                        text-decoration: none;
                        font-size: 18px;
                        color: #ddd;
                        display: block;
                    }

                    .sidebar a:hover {
                        color: #fff;
                        background-color: #495057;
                    }
                </style>
                <div class="sidebar">
                    <h4 class="text-center">Admin Panel</h4>
                    <hr>
                    <a href="index.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="leads.php"><i class="fas fa-envelope me-2"></i>Leads</a>
                    <a href="services.php"><i class="fas fa-tools me-2"></i>Servizi</a>
                    <a href="zones.php"><i class="fas fa-map-marker-alt me-2"></i>Zone</a>
                    <a href="logout.php" class="mt-5"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            <?php endif; ?>

            <h2 class="mb-4">Gestione Servizi</h2>

            <?php if ($message): ?>
                <div class="alert alert-info alert-dismissible fade show">
                    <?= $message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-plus me-2"></i>Aggiungi Nuovo Servizio
                </div>
                <div class="card-body">
                    <form method="POST" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nome Servizio</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Es. Riparazione PC">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Descrizione Breve</label>
                            <input type="text" name="description" class="form-control"
                                placeholder="Breve descrizione del servizio">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" name="add_service" class="btn btn-success w-100">Aggiungi</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Elenco Servizi (Trascina per riordinare)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="servicesTable" width="100%" cellspacing="0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50" class="text-center"><i class="fas fa-arrows-alt-v"></i></th>
                                    <th>Nome</th>
                                    <th>Slug</th>
                                    <th>Descrizione</th>
                                    <th width="100" class="text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-list">
                                <?php foreach ($services as $svc): ?>
                                    <tr data-id="<?= $svc['id'] ?>">
                                        <td class="text-center cursor-grab align-middle text-muted">
                                            <i class="fas fa-grip-lines"></i>
                                        </td>
                                        <td class="align-middle fw-bold">
                                            <?= htmlspecialchars($svc['name']) ?>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-secondary"><?= htmlspecialchars($svc['slug']) ?></span>
                                        </td>
                                        <td class="align-middle text-muted small">
                                            <?= htmlspecialchars($svc['description'] ?? '') ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form method="POST"
                                                onsubmit="return confirm('Sei sicuro di voler eliminare questo servizio?');">
                                                <input type="hidden" name="service_id" value="<?= $svc['id'] ?>">
                                                <button type="submit" name="delete_service" class="btn btn-danger btn-sm"
                                                    title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.getElementById('sortable-list');
            var sortable = Sortable.create(el, {
                animation: 150,
                handle: '.cursor-grab',
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
                    var order = [];
                    el.querySelectorAll('tr').forEach(function (row) {
                        order.push(row.getAttribute('data-id'));
                    });

                    // Send new order to server
                    fetch('update_service_order.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ order: order }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Order updated');
                            } else {
                                alert('Errore aggiornamento ordine: ' + data.error);
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Errore di connessione.');
                        });
                }
            });
        });
    </script>
</body>

</html>