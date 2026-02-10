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

            // --- SEND EMAIL NOTIFICATION ---
            require_once 'includes/mailer.php';

            // SMTP Config
            $smtpHost = 'authsmtp.securemail.pro';
            $smtpPort = 465;
            $smtpUser = 'info@riparazionepclegnano.it';
            $smtpPass = 'W6WT3k7HEe';

            $mailer = new SimpleSMTP($smtpHost, $smtpPort, $smtpUser, $smtpPass);

            // Prepare Email Content
            $subject = "Nuovo Lead: $name";
            $emailBody = "
            <h2>Nuova Richiesta di Assistenza</h2>
            <p><strong>Nome:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Telefono:</strong> " . htmlspecialchars($phone) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Messaggio:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
            <hr>
            <p>Recap: ID Servizio: $service_id, ID Zona: $zone_id</p>
            ";

            // Recipients
            $to = ['igorimc@gmail.com', 'lalegnanoinformatica@gmail.com'];

            // Send
            $mailer->send($to, $subject, $emailBody, 'Lead System', $email ?: null);
            // -------------------------------

            // Redirect to thank you page or back with success
            echo "<script>alert('Richiesta inviata con successo!'); window.history.back();</script>";
        } catch (PDOException $e) {
            echo "Errore Database: " . $e->getMessage();
        } catch (Exception $e) {
            // Log email error but don't stop flow
            error_log("Email error: " . $e->getMessage());
            echo "<script>alert('Richiesta salvata, ma errore invio notifica.'); window.history.back();</script>";
        }
    } else {
        echo "Nome e Telefono sono obbligatori.";
    }
} else {
    header("Location: /");
}
?>