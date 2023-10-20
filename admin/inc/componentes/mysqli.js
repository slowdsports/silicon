// PARTIDOS

function agregarPartido() {
    // Obtenemos los valores del formulario
    var eLocal = document.getElementById("equipoLocal").value;
    var eVisitante = document.getElementById("equipoVisitante").value;
    var eLiga = document.getElementById("partidoLiga").value;
    var pTipo = document.getElementById("partidoTipo").value;
    var pFecha = document.getElementById("partidoFecha").value;
    var starp = document.getElementById("starp")
    if (starp.checked) { starp = 1; } else { starp = 0; }
    var vix = document.getElementById("vix");
    if (vix.checked) { vix = 1; } else { vix = 0; }
    var pCanal1 = document.getElementById("partidoCanal1").value;
    var pCanal2 = document.getElementById("partidoCanal2").value;
    var pCanal3 = document.getElementById("partidoCanal3").value;
    var pCanal4 = document.getElementById("partidoCanal4").value;
    var pCanal5 = document.getElementById("partidoCanal5").value;
    var pCanal6 = document.getElementById("partidoCanal6").value;
    var pCanal7 = document.getElementById("partidoCanal7").value;
    var pCanal8 = document.getElementById("partidoCanal8").value;
    var pCanal9 = document.getElementById("partidoCanal9").value;
    var pCanal10 = document.getElementById("partidoCanal10").value;

    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Si la respuesta es OK
            if (this.response == "El juego ha sido agregado correctamente"){
                // document.getElementById("mensaje").innerHTML = this.responseText;
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#198754",
                    stopOnFocus: true
                }).showToast();
                $('#agregarPartido').modal('hide')
                console.log(this.responseText);
                // Actualizamos la tabla HTML con los nuevos datos
                setTimeout(function(){ 
                    window.location.reload();
                }, 5000);
            } else {
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                    stopOnFocus: true
                }).showToast();
            }
        }
    };
    xmlhttp.open("POST", "inc/componentes/back/insert.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("partido&equipoLocal=" + eLocal + "&equipoVisitante=" + eVisitante + "&equipoLiga=" + eLiga + "&partidoTipo=" + pTipo + "&partidoFecha=" + pFecha + "&starp=" + starp + "&vix=" + vix + "&partidoCanal1=" + pCanal1 + "&partidoCanal2=" + pCanal2 + "&partidoCanal3=" + pCanal3 + "&partidoCanal4=" + pCanal4 + "&partidoCanal5=" + pCanal5 + "&partidoCanal6=" + pCanal6 + "&partidoCanal7=" + pCanal7 + "&partidoCanal8=" + pCanal8 + "&partidoCanal9=" + pCanal9 + "&partidoCanal10=" + pCanal10);
}

function agregarPartidosAuto() {
    var elemento = document.getElementById('auto').getAttribute("data-id");
    console.log(elemento);
    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Mostramos una notificación con Toastify
            Toastify({
                text: this.responseText,
                duration: 5000,
                close: true,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#198754",
                stopOnFocus: true
            }).showToast();
            console.log(this.responseText);
        }
    };
    xmlhttp.open("POST", "inc/componentes/back/sofa.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("filtrarLiga=" + elemento);
}

function editarPartido() {
    // Obtenemos los valores del formulario
    var pId = document.getElementById("partidoId").value;
    var eLocal = document.getElementById("equipoLocal").value;
    var eVisitante = document.getElementById("equipoVisitante").value;
    var eLiga = document.getElementById("partidoLiga").value;
    var pFecha = document.getElementById("partidoFecha").value;
    var starp = document.getElementById("starp")
    if (starp.checked) { starp = 1; } else { starp = 0; }
    var vix = document.getElementById("vix");
    if (vix.checked) { vix = 1; } else { vix = 0; }
    var pCanal1 = document.getElementById("partidoCanal1").value;
    var pCanal2 = document.getElementById("partidoCanal2").value;
    var pCanal3 = document.getElementById("partidoCanal3").value;
    var pCanal4 = document.getElementById("partidoCanal4").value;
    var pCanal5 = document.getElementById("partidoCanal5").value;
    var pCanal6 = document.getElementById("partidoCanal6").value;
    var pCanal7 = document.getElementById("partidoCanal7").value;
    var pCanal8 = document.getElementById("partidoCanal8").value;
    var pCanal9 = document.getElementById("partidoCanal9").value;
    var pCanal10 = document.getElementById("partidoCanal10").value;

    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("mensaje").innerHTML = this.responseText;
            //document.getElementById("mensaje").innerHTML = "<div class='alert alert-light-info color-info'>" + this.response + "</div>";
            // Mostramos una notificación con Toastify
            Toastify({
                text: "El partido #" + pId + " ha sido modificado",
                duration: 5000,
                close: true,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#198754",
                stopOnFocus: true
            }).showToast();
            console.log(this.responseText);
        }
    };
    xmlhttp.open("POST", "inc/componentes/back/update.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + pId + "&equipoLocal=" + eLocal + "&equipoVisitante=" + eVisitante + "&equipoLiga=" + eLiga + "&partidoFecha=" + pFecha + "&starp=" + starp + "&vix=" + vix + "&partidoCanal1=" + pCanal1 + "&partidoCanal2=" + pCanal2 + "&partidoCanal3=" + pCanal3 + "&partidoCanal4=" + pCanal4 + "&partidoCanal5=" + pCanal5 + "&partidoCanal6=" + pCanal6 + "&partidoCanal7=" + pCanal7 + "&partidoCanal8=" + pCanal8 + "&partidoCanal9=" + pCanal9 + "&partidoCanal10=" + pCanal10);
}

function eliminarPartido() {
    // Obtiene una lista de todos los botones de eliminación
    var botonesEliminar = document.querySelectorAll('.eliminarPartido');

    // Agrega un evento click a cada botón de eliminación
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function () {
            var elemento = boton.getAttribute('data-id');
            console.log(elemento);

            // Creamos un objeto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();

            // Creamos la consulta AJAX
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("mensaje").innerHTML = this.responseText;
                    console.log(this.responseText);

                    // Actualizamos la tabla HTML
                    var fila = document.getElementById("partido-" + elemento);
                    if (fila) {
                        fila.parentNode.removeChild(fila);
                        // Mostramos una notificación con Toastify
                        Toastify({
                            text: "El partido #" + elemento + " ha sido eliminado",
                            duration: 5000,
                            close: true,
                            hideProgressBar: false,
                            closeOnClick: true,
                            pauseOnHover: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                            stopOnFocus: true
                        }).showToast();
                    }
                }
            };

            xmlhttp.open("POST", "inc/componentes/back/delete.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("partido&id=" + elemento);
        });
    });
}

function borrarPartidos() {
    var elemento = document.getElementById('borrarPartidos').getAttribute("data-id");
    console.log(elemento);
    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Mostramos una notificación con Toastify
            Toastify({
                text: this.responseText,
                duration: 5000,
                close: true,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#198754",
                stopOnFocus: true
            }).showToast();
            console.log(this.responseText);
        }
    };
    xmlhttp.open("POST", "inc/componentes/back/delete.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("borrarPartidos&filtrarLiga=" + elemento);
}

// CANALES

function agregarLiga() {
    // Obtenemos los valores del formulario
    var ligaId = document.getElementById("ligaId").value;
    var ligaNombre = document.getElementById("ligaNombre").value;
    var ligaImg = document.getElementById("ligaImg").value;
    var ligaPais = document.getElementById("ligaPais").value;

    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Si la respuesta es OK
            if (this.response == "La liga ha sido agregada correctamente"){
                // document.getElementById("mensaje").innerHTML = this.responseText;
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#198754",
                    stopOnFocus: true
                }).showToast();
                $('#agregarPartido').modal('hide')
                console.log(this.responseText);
                // Actualizamos la tabla HTML con los nuevos datos
                setTimeout(function(){ 
                    window.location.reload();
                }, 5000);
            } else {
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                    stopOnFocus: true
                }).showToast();
            }
        }
    };
    xmlhttp.open("POST", "func/insert.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("liga&ligaId=" + ligaId + "&ligaNombre=" + ligaNombre + "&ligaImg=" + ligaImg + "&ligaPais=" + ligaPais);
}

function agregarEquipo() {
    // Obtenemos los valores del formulario
    var equipoId = document.getElementById("equipoId").value;
    var equipoNombre = document.getElementById("equipoNombre").value;
    var equipoImg = document.getElementById("equipoImg").value;
    var equipoLiga = document.getElementById("equipoLiga").value;

    // Creamos un objeto XMLHttpRequest
    var xmlhttp = new XMLHttpRequest();

    // Creamos la consulta AJAX
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Si la respuesta es OK
            if (this.response == "El equipo ha sido agregado correctamente"){
                // document.getElementById("mensaje").innerHTML = this.responseText;
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#198754",
                    stopOnFocus: true
                }).showToast();
                $('#agregarPartido').modal('hide')
                console.log(this.responseText);
                // Actualizamos la tabla HTML con los nuevos datos
                setTimeout(function(){ 
                    window.location.reload();
                }, 5000);
            } else {
                Toastify({
                    text: this.responseText,
                    duration: 5000,
                    close: true,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                    stopOnFocus: true
                }).showToast();
            }
        }
    };
    xmlhttp.open("POST", "func/insert.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("equipo&equipoId=" + equipoId + "&equipoNombre=" + equipoNombre + "&equipoImg=" + equipoImg + "&equipoLiga=" + equipoLiga);
}

function eliminarLiga() {
    // Obtiene una lista de todos los botones de eliminación
    var botonesEliminar = document.querySelectorAll('.eliminarLiga');

    // Agrega un evento click a cada botón de eliminación
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function () {
            var elemento = boton.getAttribute('data-id');
            console.log(elemento);

            // Creamos un objeto XMLHttpRequest
            var xmlhttp = new XMLHttpRequest();

            // Creamos la consulta AJAX
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("mensaje").innerHTML = this.responseText;
                    console.log(this.responseText);

                    // Actualizamos la tabla HTML
                    var fila = document.getElementById("liga-" + elemento);
                    if (fila) {
                        fila.parentNode.removeChild(fila);
                        // Mostramos una notificación con Toastify
                        Toastify({
                            text: "La liga " + elemento + " ha sido eliminada",
                            duration: 5000,
                            close: true,
                            hideProgressBar: false,
                            closeOnClick: true,
                            pauseOnHover: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                            stopOnFocus: true
                        }).showToast();
                    }
                }
            };

            xmlhttp.open("POST", "func/delete.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("liga&id=" + elemento);
        });
    });
}