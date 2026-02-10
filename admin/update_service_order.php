<?php
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

check_admin_session();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['order']) && is_array($input['order'])) {
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("UPDATE services SET sort_order = ? WHERE id = ?");

            foreach ($input['order'] as $index => $id) {
                // Ensure $id is an integer to prevent injection
                $stmt->execute([$index, (int) $id]);
            }

            $pdo->commit();
            echo json_encode(['success' => true, 'message' => 'Ordinamento aggiornato.']);
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Dati non validi.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Metodo non consentito.']);
}
?>