
document.addEventListener("DOMContentLoaded", function () {
    const userSelect = document.getElementById("user-select");
    const selectedUsersContainer = document.getElementById("selected-users");
    const usersInput = document.getElementById("users-input");
    const userSpans = selectedUsersContainer.querySelectorAll("span");

    let selectedUsers = [];

    Array.from(userSpans).map(span => {
        selectedUsers.push(span.getAttribute('data').replaceAll('id-',""));
        usersInput.value = selectedUsers;
    });

    userSelect.addEventListener("change", function () {
        const userId = userSelect.value;
        const userName = userSelect.options[userSelect.selectedIndex].text;

        if (userId && !selectedUsers.includes(userId)) {
            selectedUsers.push(userId);

            // Crear un elemento visual para el usuario
            const userElement = document.createElement("span");
            userElement.className = "bg-gray-200 text-gray-800 px-2 py-1 rounded mr-2 inline-block";
            userElement.textContent = userName;

            // Botón para quitar usuario
            const removeBtn = document.createElement("button");
            removeBtn.className = "ml-1 text-red-500 text-sm";
            removeBtn.innerHTML = "&times;";
            removeBtn.onclick = function () {
                selectedUsers = selectedUsers.filter(id => id !== userId);
                usersInput.value = selectedUsers;
                userElement.remove();
            };

            userElement.appendChild(removeBtn);
            selectedUsersContainer.appendChild(userElement);

            // Actualizar campo oculto con los IDs seleccionados
            usersInput.value = selectedUsers;
        }
    });
});