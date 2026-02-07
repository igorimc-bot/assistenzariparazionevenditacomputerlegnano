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

    <?php include 'includes/header.php'; ?>

    <section class="hero">
        <div class="hero-slider">
            <div class="slide" style="background-image: url('/assets/img/hero_home_1.jpg')"></div>
            <div class="slide" style="background-image: url('/assets/img/hero_home_2.jpg')"></div>
            <div class="slide" style="background-image: url('/assets/img/hero_home_3.jpg')"></div>
        </div>
        <div class="hero-overlay"></div>
        <div class="container">
            <h1>Assistenza Informatica Professionale a Legnano e Provincia</h1>
            <p>Interventi rapidi e garantiti a Legnano e dintorni. Operativi con la massima rapidità.</p>
            <div class="hero-buttons">
                <a href="#contatti" class="btn-hero">Chiama Ora</a>
                <a href="#servizi" class="btn-hero-secondary">I Nostri Servizi</a>
            </div>
        </div>
    </section>

    <section id="servizi" class="services-section">
        <div class="container">
            <h2 class="section-title">I Nostri Servizi</h2>
            <p class="section-subtitle">Offriamo soluzioni informatiche complete per privati e aziende. Dalla
                riparazione hardware allo sviluppo software, i nostri tecnici esperti sono pronti a risolvere ogni tua
                esigenza con professionalità e rapidità.</p>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                    <a href="/<?= $service['slug'] ?>/legnano" class="service-card">
                        <h3>
                            <?= htmlspecialchars($service['name']) ?>
                        </h3>
                        <p>
                            <?= htmlspecialchars($service['short_description']) ?>
                        </p>
                        <span class="btn-text">Scopri di più <i class="fas fa-arrow-right"></i></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="zone" class="zones-section bg-light">
        <div class="container">
            <h2 class="section-title">Dove Operiamo</h2>
            <p class="section-subtitle">La nostra rete di assistenza copre capillarmente Legnano, Milano e tutti i
                comuni della zona. Garantiamo interventi rapidi a domicilio o presso la nostra sede, assicurando massima
                tempestività per ogni emergenza informatica.</p>
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
                <div class="form-row">
                    <input type="text" name="name" placeholder="Nome" required>
                    <input type="tel" name="phone" placeholder="Telefono" required>
                </div>
                <input type="email" name="email" placeholder="Email">

                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo di Servizio</label>
                        <select name="service_id" required>
                            <option value="" disabled selected>-- Seleziona --</option>
                            <?php foreach ($services as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Zona di Intervento</label>
                        <select name="zone_id" required>
                            <option value="" disabled selected>-- Seleziona --</option>
                            <?php foreach ($zones as $z): ?>
                                <option value="<?= $z['id'] ?>"><?= htmlspecialchars($z['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="request-types">
                    <p>Cosa ti serve? (Selezione multipla):</p>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="request_type[]" value="info" checked> Richiesta
                            Informazioni</label>
                        <label><input type="checkbox" name="request_type[]" value="quote"> Richiesta Preventivo</label>
                        <label><input type="checkbox" name="request_type[]" value="visit"> Uscita Assistenza</label>
                    </div>
                </div>

                <textarea name="message" placeholder="Descrivi il problema" rows="4"></textarea>

                <div class="privacy-wrapper">
                    <input type="checkbox" id="privacy_home" name="privacy" required>
                    <label for="privacy_home">Accetto la <a href="/privacy-policy" target="_blank">Privacy Policy</a> e
                        i <a href="/termini-servizio" target="_blank">Termini del Servizio</a>. Acconsento al
                        trattamento dei dati per la gestione della richiesta.</label>
                </div>

                <button type="submit" class="btn-submit">Invia Richiesta</button>
                <p class="legal-notice">I tuoi dati saranno trattati nel rispetto del GDPR e utilizzati esclusivamente
                    per ricontattarti in merito alla tua richiesta di assistenza.</p>
            </form>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>