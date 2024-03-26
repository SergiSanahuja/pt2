let btnTancarSession = document.getElementById("btnTancarSessio");

if (btnTancarSession) {
    btnTancarSession.addEventListener("click", function() {
        //volver al login
        window.location.href = "login.php";
    });
}