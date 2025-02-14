document.addEventListener("DOMContentLoaded", function() {
    const selects = document.querySelectorAll("select[name='status']");
    selects.forEach(select => {
        updateColor(select);
        select.addEventListener("change", function() {
            updateColor(this);
        });
    })
});

function updateColor(select) {
    const selectedOption = select.options[select.selectedIndex];
    select.style.backgroundColor = selectedOption.getAttribute('data-color');
    select.style.color = selectedOption.getAttribute('data-tx-color');
}

// Escuchar el evento de Livewire
document.addEventListener("statusUpdated", function () {
    setTimeout(() => {
        document.querySelectorAll("select[name='status']").forEach(select => {
            updateColor(select);
        });
    }, 1);
});