
function markNotificationAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json"
        },
        body: JSON.stringify({})
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recargar para actualizar la lista de notificaciones
            }
        });
}
window.markNotificationAsRead = markNotificationAsRead;


