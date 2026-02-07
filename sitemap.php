<?php
header("Content-Type: application/xml; charset=utf-8");
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>
            <?= $base_url ?>/sitemap-main.xml
        </loc>
    </sitemap>
    <sitemap>
        <loc>
            <?= $base_url ?>/sitemap-services.xml
        </loc>
    </sitemap>
    <sitemap>
        <loc>
            <?= $base_url ?>/sitemap-geo.xml
        </loc>
    </sitemap>
</sitemapindex>