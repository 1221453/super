// Abrir o popup de logout
function abrirPopupLogout() {
    document.getElementById("popup-logout").style.display = "flex";

    // Aguarda 2 segundos e depois redireciona
    setTimeout(() => {
        confirmarLogout();
    }, 2000);
}

function confirmarLogout() {
    window.location.href = 'scripts/logout.php';
}