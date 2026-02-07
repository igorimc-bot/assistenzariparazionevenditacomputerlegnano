<?php
require_once 'includes/db_connect.php';

try {
    $sql = "ALTER TABLE services ADD COLUMN short_description TEXT AFTER name";
    $pdo->exec($sql);
    echo "Success: Column 'short_description' added successfully.";
} catch (PDOException $e) {
    if ($e->getCode() == '42S21') {
        echo "Info: Column 'short_description' already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>