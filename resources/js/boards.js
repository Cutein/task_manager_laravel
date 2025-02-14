document.addEventListener("DOMContentLoaded", function() {
    const select = document.querySelector("select[name='status']");
    if (select) {
        updateColor(select);
        select.addEventListener("change", function() {
            updateColor(this);
        });
    }
});
var color="";
function updateColor(select) {
    const selectedOption = select.options[select.selectedIndex];
    color = selectedOption.getAttribute('data-color');
    select.style.backgroundColor = color;
}

// Escuchar el evento de Livewire
document.addEventListener("statusUpdated", function () {
    const select = document.querySelector("select[name='status']");
    setTimeout(() => {
        select.style.backgroundColor = color; 
    },1)

});