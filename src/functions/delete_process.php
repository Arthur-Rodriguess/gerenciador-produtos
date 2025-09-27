<?php

require '../../vendor/autoload.php';

use Project\ProductRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: application/json; charset=UTF8");
    $id = $_POST['id'] ?? null;
    $repository = new ProductRepository();
    if($repository->delete($id)) {
        echo json_encode([
            'type' => 'success',
            'message' => 'Produto excluído com sucesso.'
        ]);
    } else {
        echo json_encode([
            'type' => 'error',
            'message' => 'Erro ao excluir produto.'
        ]);
    }
    exit;
}