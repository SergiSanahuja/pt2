let btnTancarSession = document.getElementById("btnTancarSessio");

if (btnTancarSession) {
    btnTancarSession.addEventListener("click", function() {
        // Logout
        window.location.href = "login.php?logout=true";
    });
}


let linkProfes = document.getElementById("crearProfesAdmin");

