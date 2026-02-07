<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

$services = get_all_services($pdo);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elettricista Milano e Provincia - Pronto Intervento</title>
    <meta name="description"
        content="Elettricista esperto a Milano, Legnano e provincia. Interventi rapidi, impianti elettrici, certificazioni e manutenzione.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="/">La Legnano Informatica (Elettricista)</a>
            </div>
            <nav class="nav">
                <a href="#servizi">I Servizi</a>
                <a href="#zone">Zone</a>
                <a href="#contatti" class="btn-cta">Richiedi Preventivo</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Elettricista Professionista a Milano e Provincia</h1>
            <p>Interventi rapidi e garantiti a Legnano e dintorni. Operativi H24.</p>
            <a href="#contatti" class="btn-hero">Chiama Ora</a>
        </div>
    </section>

    <section id="servizi" class="services-section">
        <div class="container">
            <h2 class="section-title">I Nostri Servizi</h2>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <h3>
                            <?= htmlspecialchars($service['name']) ?>
                        </h3>
                        <p>
                            <?= htmlspecialchars($service['description']) ?>
                        </p>
                        <a href="/<?= $service['slug'] ?>/legnano" class="btn-text">Scopri di più &rarr;</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="zone" class="zones-section bg-light">
        <div class="container">
            <h2 class="section-title">Dove Operiamo</h2>
            <p class="text-center">Siamo presenti a Legnano, Milano e in tutta la provincia.</p>
            <div class="zones-list">
                <!-- Example static links, ideally dynamic or just main ones -->
                <a href="/riparazione-guasti/legnano">Legnano</a>
                <a href="/riparazione-guasti/milano">Milano</a>
                <a href="/riparazione-guasti/busto-arsizio">Busto Arsizio</a>
                <a href="/riparazione-guasti/castellanza">Castellanza</a>
                <a href="/riparazione-guasti/rho">Rho</a>
            </div>
        </div>
    </section>

    <section id="contatti" class="contact-section">
        <div class="container">
            <h2 class="section-title">Contattaci</h2>
            <form action="process_lead.php" method="POST" class="contact-form">
                <input type="text" name="name" placeholder="Nome" required>
                <input type="tel" name="phone" placeholder="Telefono" required>
                <input type="email" name="email" placeholder="Email">
                <textarea name="message" placeholder="Descrivi il problema" rows="4"></textarea>
                <button type="submit" class="btn-submit">Invia Richiesta</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy;
                <?= date('Y') ?> La Legnano Informatica. P.IVA xxxxxxxxxx
            </p>
        </div>
    </footer>

</body>

</html>