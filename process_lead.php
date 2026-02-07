<?php
require_once 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $service_id = $_POST['service_id'] ?? null;
    $zone_id = $_POST['zone_id'] ?? null;

    if ($zone_id === '')
        $zone_id = null;

    if ($name && $phone) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (name, phone, email, message, service_id, zone_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $email, $message, $service_id, $zone_id]);

            // Redirect to thank you page or back with success
            echo "<script>alert('Richiesta inviata con successo!'); window.history.back();</script>";
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    } else {
        echo "Nome e Telefono sono obbligatori.";
    }
} else {
    header("Location: /");
}
?>