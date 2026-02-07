<?php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

header("Content-Type: application/xml; charset=utf-8");
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

// Get all service-zone combinations
$stmt = $pdo->query("
    SELECT s.slug as service_slug, z.slug as zone_slug 
    FROM services s 
    CROSS JOIN zones z
");
$combinations = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc><?= $base_url ?>/<?= $row['service_slug'] ?>/<?= $row['zone_slug'] ?></loc>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    <?php endforeach; ?>
</urlset>