<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

$services = get_all_services($pdo);
$zones = get_all_zones($pdo);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistenza Computer Legnano e Provincia - Pronto Intervento</title>
    <meta name="description"
        content="Assistenza informatica esperta a Legnano, Milano e provincia. Riparazione PC, siti web, recupero dati e servizi digitali.">
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
                <a href="/">La Legnano Informatica (Riparazione PC)</a>
            </div>
            <nav class="nav">
                <a href="#servizi">I Servizi</a>
                <a href="#zone">Zone</a>
                <a href="#contatti" class="btn-cta">Richiedi Preventivo</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-slider">
            <div class="slide" style="background-image: url('https://source.unsplash.com/1920x1080/?gaming,pc,rgb')">
            </div>
            <div class="slide"
                style="background-image: url('https://source.unsplash.com/1920x1080/?server,datacenter,blue')"></div>
            <div class="slide"
                style="background-image: url('https://source.unsplash.com/1920x1080/?motherboard,circuit,tech')"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="container">
            <h1>Assistenza Informatica Professionale a Legnano e Provincia</h1>
            <p>Interventi rapidi e garantiti a Legnano e dintorni. Operativi H24.</p>
            <div class="hero-buttons">
                <a href="#contatti" class="btn-hero">Chiama Ora</a>
                <a href="#servizi" class="btn-hero-secondary">I Nostri Servizi</a>
            </div>
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
            <div class="zones-wrapper">
                <div class="zones-column">
                    <h3><i class="fas fa-map-marker-alt"></i> Comuni Limitrofi</h3>
                    <div class="zones-list">
                        <?php foreach ($zones as $zone): ?>
                            <?php if ($zone['type'] == 'Comune'): ?>
                                <a href="/riparazione-pc/<?= $zone['slug'] ?>"><?= htmlspecialchars($zone['name']) ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="zones-column">
                    <h3><i class="fas fa-city"></i> Milano Città</h3>
                    <div class="zones-list">
                        <?php foreach ($zones as $zone): ?>
                            <?php if ($zone['type'] == 'Quartiere'): ?>
                                <a href="/riparazione-pc/<?= $zone['slug'] ?>"><?= htmlspecialchars($zone['name']) ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
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