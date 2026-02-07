<?php
header("Content-Type: application/xml; charset=utf-8");
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $base_url ?>/</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= $base_url ?>/privacy-policy</loc>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc><?= $base_url ?>/termini-servizio</loc>
        <changefreq>monthly</changefreq>
        <priority>0.2</priority>
    </url>
    <url>
        <loc><?= $base_url ?>/cookie-policy</loc>
        <changefreq>monthly</changefreq>
        <priority>0.1</priority>
    </url>
</urlset>