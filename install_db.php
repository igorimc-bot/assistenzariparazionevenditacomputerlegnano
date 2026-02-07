<?php
require_once 'includes/db_connect.php';

try {
    // Read and execute database.sql
    $sql = file_get_contents('database.sql');
    $pdo->exec($sql);
    echo "Tabelle create con successo.<br>";

    // Read and execute seed_data.sql
    $seed_sql = file_get_contents('seed_data.sql');
    $pdo->exec($seed_sql);
    echo "Dati iniziali inseriti con successo.<br>";

    echo "<hr>Installazione completata! <a href='/'>Vai alla Home</a> o <a href='/admin/login.php'>Accedi come Admin</a> (user: admin, pass: admin)";

} catch (PDOException $e) {
    echo "Errore durante l'installazione: " . $e->getMessage();
}
?>