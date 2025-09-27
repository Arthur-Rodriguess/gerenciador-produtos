<!-- require do cabeçalho que é igual para todas as páginas -->
<?php require 'includes/header.php';?>

    <main class="main-content">
        <!-- outro require porém de uma sidebar -->
        <?php require 'includes/aside.php';?>
        <div class="main-container">
            <h1 class="main-content__title">Registrar Produto</h1>
            <!-- formulário de registro -->
            <section class="form-container">
                <form method="post" autocomplete="off" class="form">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Digite o nome do produto" class="form__input" required>
                    <label for="price">Preço</label>
                    <input type="number" name="price" id="price" placeholder="Digite o preço do produto" class="form__input" step="any" required>
                    <label for="description">Descrição</label>
                    <input type="text" name="description" id="description" placeholder="Digite a descrição do produto" class="form__input">
                    <input type="submit" value="Salvar Produto" class="form__input submit">
                </form>
            </section>
        </div>
        <!-- div que tem como objetivo mostrar ao usuário um log do envio do formulário -->
        <div id="log" class="log <?= $type ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    </main>

    <script>
        /** Script focado em fazer uma requisição ao servidor sem recarregar a página
         * utilizando AJAX
        */
        const form = document.querySelector('.form');
        const log = document.getElementById('log');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            fetch('api/register_process.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    log.textContent = data.message;
                    log.className = `log ${data.type} show`;
                    setTimeout(() => {
                        log.classList.remove('show');
                    }, 3000);

                    if (data.type === 'success') {
                        form.reset();
                    }
                })
                .catch(() => {
                    log.textContent = 'Erro na requisição.';
                    log.className = 'log error show';
                    setTimeout(() => {
                        log.classList.remove('show');
                    }, 3000);
                });
        });
    </script>
</body>
</html>
