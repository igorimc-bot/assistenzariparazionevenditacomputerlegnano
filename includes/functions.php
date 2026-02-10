<?php
function check_admin_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        header("Location: /admin/login.php");
        exit;
    }
}

function slugify($text)
{
    if (empty($text)) {
        return '';
    }
    // Convert to lowercase
    $text = strtolower($text);

    // Replace non-letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function get_all_services($pdo)
{
    $stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC, name ASC");
    return $stmt->fetchAll();
}

function get_all_zones($pdo)
{
    $stmt = $pdo->query("SELECT * FROM zones ORDER BY name ASC");
    return $stmt->fetchAll();
}

function get_service_by_slug($pdo, $slug)
{
    $stmt = $pdo->prepare("SELECT * FROM services WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function get_zone_by_slug($pdo, $slug)
{
    $stmt = $pdo->prepare("SELECT * FROM zones WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}
?>