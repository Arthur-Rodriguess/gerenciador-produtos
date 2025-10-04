<?php 
require '../vendor/autoload.php';

use Project\ProductRepository;

$repository = new ProductRepository();
$products = $repository->findAll();
?>

<?php require 'includes/header.php'; ?>

<main class="main-content aside-hidden" id="main-content">
    <?php require 'includes/aside.php'; ?>
    <section class="main-container">
        <h1 class="main-content__title">Ver Produtos</h1>
        <?php if (count($products) > 0): ?>
            <div class="container-itens">
                <?php foreach($products as $product): ?>
                    <div class="product-card"
                        data-id="<?=$product->getId()?>"
                        data-name="<?=htmlspecialchars($product->getName())?>"
                        data-price="<?=htmlspecialchars($product->getPrice())?>"
                        data-description="<?=htmlspecialchars($product->getDescription())?>">
                        <h2 class="product-name"><?= htmlspecialchars($product->getName()) ?></h2>
                        <p class="product-price">R$ <?= number_format($product->getPrice(), 2, ",", ".") ?></p>
                        <p class="product-description"><?= htmlspecialchars($product->getDescription()) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nenhum produto registrado.</p>
        <?php endif; ?>
    </section>
    <div id="log" class="log <?= $type ?>">
        <?= htmlspecialchars($message) ?>
    </div>
</main>


<div id="product-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title"></h2>
        <p id="modal-desc"></p>
        <div class="modal-actions">
            <form action="update.php" id="update-form" method="get">
                <input type="hidden" name="id" id="update-id">
                <button type="submit" class="btn-update">Atualizar</button>
            </form>
            <form action="delete.php" method="post" id="delete-form">
                <input type="hidden" name="id" id="delete-id">
                <button type="submit" class="btn-delete">Excluir</button>
            </form>
        </div>
    </div>
</div>

<script src="js/global.js"></script>
<script src="js/read.js"></script>