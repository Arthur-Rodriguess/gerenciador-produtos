<?php

use Project\ProductRepository;

require '../../vendor/autoload.php';
require '../../fpdf/fpdf.php';

$repository = new ProductRepository();
$products = $repository->findAll();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 15, utf8_decode('Produtos Registrados'), 0, 1, 'C');

foreach($products as $product) {
    $price = number_format($product->getPrice(), 2, ",", ".");
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(0, 10, utf8_decode("Nome: {$product->getName()}"), 0, 1);
    $pdf->Cell(0, 10, utf8_decode("Preço: R$ {$price}"), 0, 1);
    $pdf->MultiCell(0, 10, utf8_decode("Descrição: {$product->getDescription()}"), 0, 1);
    $pdf->Ln(5);
}

$pdf->Output('D', 'produtos.pdf');
exit;