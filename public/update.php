<?php
require '../vendor/autoload.php';
use Project\ProductRepository;

$repository = new ProductRepository();
$id = $_GET['id'] ?? null;
if (!$id) die('ID do produto não fornecido.');
$product = $repository->findById($id);
if (!$product) die('Produto não encontrado.');
?>

<?php require 'includes/header.php';?>
    
    <main class="main-content aside-hidden" id="main-content">
        <?php require 'includes/aside.php';?>
        <div class="main-container">
            <h1 class="main-content__title">Atualizar Produto</h1>
            <section class="form-container">
                <form method="post" autocomplete="off" class="form">
                    <p style="color: gray; font-size: 14px; text-align: center;">*altere uma mais características</p>
                    <input type="hidden" name="id" value="<?=htmlspecialchars($product->getId())?>">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Digite o novo nome do produto" class="form__input">
                    <label for="price">Preço</label>
                    <input type="number" name="price" id="price" placeholder="Digite o novo preço do produto" class="form__input" step="any">
                    <label for="description">Descrição</label>
                    <input type="text" name="description" id="description" placeholder="Digite a nova descrição do produto" class="form__input">
                    <input type="submit" value="Atualizar Produto" class="form__input submit">
                </form>
            </section>
        </div>
        <div id="log" class="log <?= $type ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    </main>

<script src="js/global.js"></script>
<script src="js/update.js"></script>