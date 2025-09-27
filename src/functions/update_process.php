<?php
require '../../vendor/autoload.php';

use Project\ProductRepository;

$repository = new ProductRepository();

$type = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';
    $product = $repository->findById($id);
    if (!$product) {
        echo "<p>Produto não encontrado.</p>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=UTF8');
    
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $description = $_POST['description'] ?? null;
    $product = $repository->findById($id);
    
    if ($name) $product->setName($name);
    if ($price) $product->setPrice($price);
    if ($description) $product->setDescription($description);

    
    if ($repository->update($product)) {
        echo json_encode([
            'type' => 'success',
            'message' => 'Produto atualizado com sucesso.'
        ]);
    } else {
        echo json_encode([
            'type' => 'error',
            'message' => 'Erro ao atualizar produto.'
        ]);
    }
    exit;
}