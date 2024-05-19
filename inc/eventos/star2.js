document.addEventListener("DOMContentLoaded", () => {
    const jsonUrl = "datos.json?";
    const filtroInput = document.getElementById("filtroInput");
    const eventosContainer = document.getElementById("eventos");
    // Filtro
    filtroInput.addEventListener("input", () => {
        const filtro = filtroInput.value.toLowerCase();
        const tarjetas = eventosContainer.querySelectorAll(".evento");
        tarjetas.forEach((tarjeta) => {
            const titulo = tarjeta.querySelector("h3").textContent.toLowerCase();
            tarjeta.style.display = titulo.includes(filtro) ? "block" : "none";
        });
    });
    // Desencriptar y modificar la URL del evento
    function procesarURL(url) {
        if (url.trim() === "#") {
            return url;
        }

        var parteDespreciable = "/embed/eventos/?r=";
        var urlSinParteDespreciable = url.replace(parteDespreciable, "");
        var desencriptada = atob(urlSinParteDespreciable);
        //desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, "");
        //desencriptada = desencriptada.replace(/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/, "");
        // Intenta reemplazar el primer regex
        if (/https:\/\/\S*\/star_jwp\.html\?get=/.test(desencriptada)) {
            desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, "");
        } else if (/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/.test(desencriptada)) {
            // Si el primer regex no coincide, intenta el segundo regex
            desencriptada = desencriptada.replace(/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/, "");
        }
        console.log(desencriptada)

        return desencriptada;
    }

    function encriptarContenido(eventoUrl) {
        if (eventoUrl.trim() !== "#") {
            var partes = eventoUrl.split("&");
            var urlEncriptada = partes
                .map(function (part) {
                    if (part.startsWith("key=") || part.startsWith("key2=") || part.startsWith("img=")) {
                        var igualIndex = part.indexOf("=");
                        var clave = part.substring(0, igualIndex + 1);
                        var valor = part.substring(igualIndex + 1);

                        if (clave === "img=") {
                            return clave + valor;
                        } else {
                            return clave + btoa(valor);
                        }
                    }
                    return part;
                })
                .join("&");

            var partesURL = urlEncriptada.split("&");
            var primeraParte = partesURL[0];
            var primeraParteEncriptada = btoa(primeraParte);
            urlEncriptada = urlEncriptada.replace(primeraParte, primeraParteEncriptada);

            return urlEncriptada;
        }

        return eventoUrl;
    }
    // Fetch
    fetch(jsonUrl)
        .then((response) => response.json())
        .then((data) => {
            // Ordenar los eventos por estado
            data.sort((a, b) => {
                const statusA = a.status.toLowerCase();
                const statusB = b.status.toLowerCase();

                if (statusA === "en vivo") return -1;
                if (statusB === "en vivo") return 1;
                if (statusA.includes(":")) return -1;
                if (statusB.includes(":")) return 1;
                if (statusA === "finalizado") return 1;
                if (statusB === "finalizado") return -1;
                return 0;
            });
            data.forEach((evento) => {
                const card = document.createElement("div");
                card.className = "col pb-1 pb-lg-3 mb-4 evento";
                const eventoUrl = procesarURL(evento.url);
                var urlEncriptada = encriptarContenido(eventoUrl);
                console.log(eventoUrl)
                // Modificar el contenido de acuerdo al status del evento
                var contenidoExtra = "";
                if (evento.status === "EN VIVO") {
                    contenidoExtra = '<span class="badge bg-success position-absolute top-0 start-0 zindex-2 mt-3 ms-3">En Vivo</span>';
                    contenidoIcon = "bx bxs-circle bx-flashing";
                } else if (evento.status === "FINALIZADO") {
                    contenidoExtra = '<span class="badge bg-danger position-absolute top-0 start-0 zindex-2 mt-3 ms-3">Finalizado</span>';
                    contenidoIcon = "bx bx-timer";
                } else {
                    contenidoExtra = `<span class="badge bg-info position-absolute top-0 start-0 zindex-2 mt-3 ms-3">${evento.status}</span>`;
                    contenidoIcon = "bx bxs-time";
                }
                // Verificar si el evento tiene una hora específica
                var $remaining = "";
                if (evento.status.includes(":")) {
                    // Calcular la diferencia de tiempo entre ahora y el evento
                    var eventTime = new Date();
                    var eventParts = evento.status.split(":");
                    var eventHours = parseInt(eventParts[0], 10);
                    var eventMinutes = parseInt(eventParts[1], 10);
                    
                    // Ajustar la hora del evento a UTC-2
                    eventHours -= 2;
                    if (eventHours < 0) {
                        eventHours += 24; // Si es negativo, sumar 24 para obtener la hora del día anterior
                    }
                    
                    eventTime.setUTCHours(eventHours, eventMinutes, 0);
                    // Función para actualizar el contador regresivo
                    function updateCountdown() {
                        var now = new Date();
                        var timeDiff = eventTime - now;
                        // Calcular horas, minutos y segundos
                        var hours = Math.floor(timeDiff / (1000 * 60 * 60));
                        var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                        // Actualizar el contenido del contador regresivo
                        card.innerHTML = `
                        <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                            <div class="position-relative">
                                <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                                </a>
                                ${contenidoExtra}
                                <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites"
                                data-bs-original-title="Save to Favorites">
                                    <i class="bx bx-bookmark"></i>
                                </a>
                                <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top" alt="${evento.league}">
                            </div>
                            <div class="card-body pb-3">
                                <h3 class="h5 mb-2">
                                    <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}">${evento.title}
                                    </a>
                                </h3>
                                <p class="fs-sm mb-2">${evento.league}</p>
                            </div>
                            <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                                <div class="d-flex align-items-center me-4">
                                    <i class="${contenidoIcon} fs-xl me-1"></i>
                                    ${hours}h ${minutes}m ${seconds}s
                                </div>
                            </div>
                        </article>`;
                        // Actualizar el contador cada segundo
                        setTimeout(updateCountdown, 1000);
                    }
                    // Iniciar el contador regresivo
                    updateCountdown();
                } else {
                    // Si no hay hora específica, mostrar el evento sin contador
                    $remaining = `${evento.status}`;
                }
                card.innerHTML = `
                <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                    <div class="position-relative">
                        <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                        </a>
                        ${contenidoExtra}
                        <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites" data-bs-original-title="Save to Favorites">
                            <i class="bx bx-bookmark"></i>
                        </a>
                        <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top" alt="${evento.league}">
                    </div>
                    <div class="card-body pb-3">
                        <h3 class="h5 mb-2">
                            <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}">${evento.title}</a>
                        </h3>
                        <p class="fs-sm mb-2">${evento.league}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                        <div class="d-flex align-items-center me-4">
                            <i class="${contenidoIcon} fs-xl me-1"></i>
                            ${evento.status}
                        </div>
                    </div>
                </article>`;
                eventosContainer.appendChild(card);
            });
        })
        .catch((error) => {
            console.error("Error al obtener el JSON:", error);
        });
    });