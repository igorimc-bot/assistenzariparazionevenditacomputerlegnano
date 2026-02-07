<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

$service_slug = $_GET['service'] ?? '';
$zone_slug = $_GET['zone'] ?? 'legnano'; // Default to Legnano if not specified

$service = get_service_by_slug($pdo, $service_slug);
$zone = get_zone_by_slug($pdo, $zone_slug);
$all_zones = get_all_zones($pdo);
$all_services = get_all_services($pdo);

if (!$service) {
    // Falback: redirect to home or show 404
    header("HTTP/1.0 404 Not Found");
    echo "Servizio non trovato.";
    exit;
}

if (!$zone) {
    // Fallback zone or 404
    $zone = ['name' => 'Legnano e Provincia', 'slug' => 'legnano', 'parent_city' => ''];
}

$page_title = htmlspecialchars($service['name']) . " a " . htmlspecialchars($zone['name']);
if ($zone['parent_city']) {
    $page_title .= " (" . htmlspecialchars($zone['parent_city']) . ")";
}

$meta_description = "Cerchi " . htmlspecialchars($service['name']) . " a " . htmlspecialchars($zone['name']) . "? Intervento rapido ed economico. Chiama ora per un preventivo gratuito!";
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page_title ?> - Assistenza Computer Pronto Intervento
    </title>
    <meta name="description" content="<?= $meta_description ?>">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="/">La Legnano Informatica (Riparazione PC)</a>
            </div>
            <nav class="nav">
                <a href="/">Home</a>
                <a href="#contatti" class="btn-cta">Richiedi Preventivo</a>
            </nav>
        </div>
    </header>

    <section class="hero-geo">
        <div class="container">
            <h1>
                <?= $page_title ?>
            </h1>
            <p>Servizio professionale disponibile H24 a
                <?= htmlspecialchars($zone['name']) ?>.
            </p>
            <div class="hero-buttons">
                <a href="tel:+390000000000" class="btn-hero"><i class="fas fa-phone"></i> Chiama Subito</a>
                <a href="#contatti" class="btn-hero-secondary">Scrivici</a>
            </div>
        </div>
    </section>

    <section class="details-section">
        <div class="container">
            <div class="content-wrapper">
                <div class="col-text">
                    <h2>Assistenza Specialistica: <?= htmlspecialchars($service['name']) ?></h2>
                    <p class="intro-text">Stai cercando un tecnico esperto per
                        <strong><?= htmlspecialchars($service['name']) ?> a
                            <?= htmlspecialchars($zone['name']) ?></strong>? Offriamo un servizio di pronto intervento
                        professionale, risolutivo e trasparente.</p>

                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <i class="fas fa-bolt"></i>
                            <div>
                                <strong>Intervento Rapido</strong>
                                <p>Siamo operativi a <?= htmlspecialchars($zone['name']) ?> con tempi di risposta
                                    brevissimi.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Garanzia 100%</strong>
                                <p>Ogni nostra riparazione è coperta da garanzia e assistenza post-intervento.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-euro-sign"></i>
                            <div>
                                <strong>Prezzi Chiari</strong>
                                <p>Preventivi gratuiti e trasparenti prima di ogni riparazione, senza sorprese.</p>
                            </div>
                        </div>
                    </div>

                    <div class="service-details-box">
                        <h3>Dettagli del Servizio</h3>
                        <p class="service-desc"><?= nl2br(htmlspecialchars($service['description'])) ?></p>
                    </div>

                    <div class="local-trust">
                        <p><i class="fas fa-map-marker-alt"></i> Il nostro laboratorio e i nostri tecnici mobili servono
                            quotidianamente la zona di <strong><?= htmlspecialchars($zone['name']) ?></strong>,
                            garantendo la massima comodità per te o la tua azienda.</p>
                    </div>
                </div>
                <div class="col-form" id="contatti">
                    <h3>Richiedi Assistenza</h3>
                    <p>Ti risponderemo in pochi minuti.</p>
                    <form action="/process_lead.php" method="POST">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="tel" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Email (Opzionale)</label>
                            <input type="email" name="email">
                        </div>

                        <div class="form-group">
                            <label>Servizio richiesto</label>
                            <select name="service_id" required>
                                <?php foreach ($all_services as $s): ?>
                                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $service['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($s['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Zona di intervento</label>
                            <select name="zone_id" required>
                                <?php foreach ($all_zones as $z): ?>
                                    <option value="<?= $z['id'] ?>" <?= (isset($zone['id']) && $z['id'] == $zone['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($z['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Cosa ti serve? (Selezione multipla)</label>
                            <div class="checkbox-group-vertical">
                                <label><input type="checkbox" name="request_type[]" value="info" checked> Richiesta
                                    Informazioni</label>
                                <label><input type="checkbox" name="request_type[]" value="quote"> Richiesta
                                    Preventivo</label>
                                <label><input type="checkbox" name="request_type[]" value="visit"> Uscita
                                    Assistenza</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Dettagli problema</label>
                            <textarea name="message" rows="3"></textarea>
                        </div>

                        <div class="privacy-wrapper">
                            <input type="checkbox" id="privacy_geo" name="privacy" required>
                            <label for="privacy_geo">Accetto la <a href="/privacy-policy" target="_blank">Privacy
                                    Policy</a> e i <a href="/termini-servizio" target="_blank">Termini del Servizio</a>.
                                Acconsento al trattamento dei dati per la
                                gestione della richiesta.</label>
                        </div>

                        <button type="submit" class="btn-submit-full">Invia Richiesta</button>
                        <p class="legal-notice">I tuoi dati saranno trattati nel rispetto del GDPR e utilizzati
                            esclusivamente per ricontattarti in merito alla tua richiesta di assistenza.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="zones-section bg-dark">
        <div class="container">
            <h2 class="section-title">
                <span><?= htmlspecialchars($service['name']) ?></span> anche in altre zone
            </h2>
            <div class="zones-wrapper">
                <div class="zones-column">
                    <h3><i class="fas fa-map-marker-alt"></i> Comuni Limitrofi</h3>
                    <div class="zones-list">
                        <?php foreach ($all_zones as $z): ?>
                            <?php if ($z['type'] == 'Comune' && $z['slug'] !== $zone['slug']): ?>
                                <a href="/<?= $service['slug'] ?>/<?= $z['slug'] ?>">
                                    <?= htmlspecialchars($z['name']) ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="zones-column">
                    <h3><i class="fas fa-city"></i> Milano Città</h3>
                    <div class="zones-list">
                        <?php foreach ($all_zones as $z): ?>
                            <?php if ($z['type'] == 'Quartiere' && $z['slug'] !== $zone['slug']): ?>
                                <a href="/<?= $service['slug'] ?>/<?= $z['slug'] ?>">
                                    <?= htmlspecialchars($z['name']) ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy;
                <?= date('Y') ?> La Legnano Informatica. Servizio attivo a
                <?= htmlspecialchars($zone['name']) ?> e limitrofi.
            </p>
        </div>
    </footer>

</body>

</html>