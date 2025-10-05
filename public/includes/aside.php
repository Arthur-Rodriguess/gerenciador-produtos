<aside class="sidebar">
    <?php $currentPage = basename($_SERVER['PHP_SELF']);?>
    <nav class="sidebar__links" id="sidebar">
        <a href="/register.php" class="sidebar__link <?= $currentPage === 'register.php' ? 'active' : ''?>">Registrar Produto</a>
        <a href="/read.php" class="sidebar__link <?= $currentPage === 'read.php' ? 'active' : ''?>">Ver Produtos</a>
        <a href="/api/create_pdf.php" class="sidebar__link <?= $currentPage === 'create_pdf.php' ? 'active' : ''?>">Baixar PDF</a>
    </nav>
</aside>