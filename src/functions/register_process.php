<?php
require __DIR__ . '/../../vendor/autoload.php';

use Project\Database;
use Project\Product;
use Project\ProductRepository;


Database::createTable();
$repository = new ProductRepository();

$type = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    header("Content-Type: application/json; charset=UTF8");

    $productName = $_POST['name'];
    $productDesc = $_POST['description'] ?? null;
    $productPrice = (float) htmlspecialchars($_POST['price'] ?? 0);

    $product = new Product($productName, $productDesc, $productPrice);
    if ($repository->create($product)) {
        echo json_encode([
            'type' => 'success',
            'message' => 'Produto registrado com sucesso.'
        ]);
    } else {
        echo json_encode([
            'type' => 'error',
            'message' => 'Erro ao registrar produto.'
        ]);
    }
    exit;
}