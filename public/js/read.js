const modal = document.getElementById('product-modal');
const closeBtn = modal.querySelector('.close');
const modalTitle = document.getElementById('modal-title');
const modalDesc = document.getElementById('modal-desc');
const updateId = document.getElementById('update-id');
const deleteId = document.getElementById('delete-id');
const deleteForm = document.getElementById('delete-form');
const log = document.getElementById('log');

// Abre o modal ao clicar no card
document.querySelectorAll(".product-card").forEach(card => {
    card.addEventListener("click", () => {
        const id = card.dataset.id;
        const name = card.dataset.name;
        const desc = card.dataset.description;

        modalTitle.textContent = name;
        modalDesc.textContent = desc;

        updateId.value = id;
        deleteId.value = id;

        modal.style.display = "flex";
    });
});

// Fecha o modal
closeBtn.addEventListener("click", () => modal.style.display = "none");
window.addEventListener("click", e => {
    if(e.target === modal) modal.style.display = "none";
});

deleteForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(deleteForm);

    fetch('api/delete_process.php', { method: "POST", body: formData})
    .then(res => res.json())
    .then(data => {
        log.textContent = data.message;
        log.className = `log ${data.type} show`;

        setTimeout(() => {
            log.classList.remove("show");
        }, 3000);

        if (data.type === 'success') {
            modal.style.display = 'none';
            const card = document.querySelector(`.product-card[data-id="${deleteId.value}"]`);
            if (card) card.remove();
        }
    })
    .catch(() => {
        log.textContent = "Erro na requisição.";
        log.className = "log error show";
        setTimeout(() => {
            log.classList.remove("show");
        }, 3000);
    });
});