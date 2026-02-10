<?php
$page_title = "Grazie - Assistenza Computer Legnano";
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PNRRBC5F4B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-PNRRBC5F4B');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page_title ?>
    </title>
    <link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/cookie-banner.css">
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

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent-banner">
        <div class="cookie-content">
            <div class="cookie-text">
                <h3>Questo sito utilizza i cookie</h3>
                <p>
                    Utilizziamo i cookie per migliorare la tua esperienza di navigazione.
                    <a href="/cookie-policy" target="_blank">Maggiori informazioni</a>
                </p>
            </div>
            <div class="cookie-buttons">
                <button id="cookie-accept-all" class="cookie-btn">Accetta tutti</button>
                <button id="cookie-reject-all" class="cookie-btn">Rifiuta tutti</button>
                <button id="cookie-manage" class="cookie-btn">Gestisci preferenze</button>
            </div>
        </div>
    </div>

    <!-- Cookie Preferences Modal -->
    <div id="cookie-preferences-modal">
        <div class="cookie-modal-content">
            <div class="cookie-modal-header">
                <h2>Gestisci le tue preferenze sui cookie</h2>
                <button id="cookie-modal-close">&times;</button>
            </div>
            <div class="cookie-modal-body">
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Cookie Necessari</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" checked disabled>
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p>
                        Questi cookie sono essenziali per il funzionamento del sito e non possono essere disabilitati.
                        Vengono utilizzati per la navigazione e per fornire le funzionalità di base.
                    </p>
                </div>

                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Cookie Analitici</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" id="cookie-analytics">
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p>
                        Questi cookie ci aiutano a capire come i visitatori interagiscono con il nostro sito.
                        Raccogliamo e analizziamo dati in forma anonima tramite Google Analytics.
                    </p>
                </div>
            </div>
            <div class="cookie-modal-footer">
                <button id="cookie-save-preferences" class="cookie-btn">Salva preferenze</button>
            </div>
        </div>
    </div>

    <script src="/assets/js/cookie-consent.js"></script>

</body>

</html>