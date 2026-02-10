<?php
$page_title = "Grazie - Assistenza Computer Legnano";
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page_title ?>
    </title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .thank-you-section {
            padding: 80px 20px;
            text-align: center;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .thank-you-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        .contact-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin: 30px auto;
            max-width: 500px;
            width: 100%;
        }

        .contact-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .contact-name {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <section class="thank-you-section">
        <div class="container">
            <i class="fas fa-check-circle thank-you-icon"></i>
            <h1>Richiesta Inviata con Successo!</h1>
            <p class="lead">Grazie per averci contattato. Abbiamo ricevuto la tua richiesta e ti risponderemo il prima
                possibile.</p>

            <div class="contact-box">
                <p>Se hai urgenza, chiamaci direttamente:</p>

                <div class="mb-3">
                    <div class="contact-number"><i class="fas fa-phone-alt"></i> 389 6338387</div>
                    <div class="contact-name">Dany</div>
                </div>

                <div class="mb-3">
                    <div class="contact-number"><i class="fas fa-phone-alt"></i> 340 7677611</div>
                    <div class="contact-name">Cristian</div>
                </div>
            </div>

            <a href="/" class="btn-hero">Torna alla Home</a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>