const form = document.querySelector('.form');
const log = document.getElementById('log');

form.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(form);
    fetch('api/update_process.php', { method: 'POST', body: formData })
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