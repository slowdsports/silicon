<section class="container">
    <!-- Page title + Filters -->
    <div class="d-lg-flex align-items-center justify-content-between py-4 mt-lg-2">
        <h1 class="me-3">Vix+</h1>
        <div class="d-md-flex mb-3">
            <div class="position-relative" style="min-width: 300px;">
                <input id="filtroInput" type="text" class="form-control pe-5" placeholder="Buscar evento">
                <i class="bx bx-search text-nav fs-lg position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>
        </div>
    </div>
    <!-- Courses grid -->
    <div id="eventos" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 mt-n2 mt-sm-0">

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // URL del JSON
                var jsonUrl = "https://corsproxy.io/?https://librefutboltv.com/vix-plus/eventos.json";

                // Elemento de entrada para filtrar
                var filtroInput = document.getElementById('filtroInput');

                // Elemento donde se mostrarán las tarjetas de eventos
                var eventosContainer = document.getElementById('eventos');

                // Manejar el evento de entrada para filtrar las tarjetas
                filtroInput.addEventListener('input', function () {
                    var filtro = filtroInput.value.toLowerCase(); // Obtener el valor del campo de entrada en minúsculas

                    // Iterar sobre las tarjetas y mostrar/ocultar según el criterio de filtrado
                    var tarjetas = eventosContainer.querySelectorAll('.evento');
                    tarjetas.forEach(function (tarjeta) {
                        var titulo = tarjeta.querySelector('h3').textContent.toLowerCase(); // Obtener el título de la tarjeta en minúsculas

                        // Mostrar la tarjeta si el criterio de filtrado está en el título, de lo contrario, ocultarla
                        if (titulo.includes(filtro)) {
                            tarjeta.style.display = 'block';
                        } else {
                            tarjeta.style.display = 'none';
                        }
                    });
                });

                // Desencriptar y modificar la URL del evento
                function procesarURL(url) {
                    // Verificar si el URL es "#"
                    if (url.trim() === "#") {
                        // Devolver el URL original sin modificaciones
                        return url;
                    }

                    // Eliminar la parte inicial de la URL
                    var parteDespreciable = "/embed/eventos/?r=";
                    var urlSinParteDespreciable = url.replace(parteDespreciable, '');

                    // Desencriptar URL en base64
                    var desencriptada = atob(urlSinParteDespreciable);

                    // Reemplazar parte de la cadena si es necesario
                    desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, '');
                    //desencriptada = desencriptada.replace('oldpart', 'newpart');

                    return desencriptada;
                }


                // Hacer la solicitud usando JavaScript
                fetch(jsonUrl)
                    .then(response => response.json())
                    .then(data => {
                        // Iterar sobre los eventos y crear las tarjetas
                        data.forEach(evento => {
                            var card = document.createElement('div');
                            card.className = 'col pb-1 pb-lg-3 mb-4 evento';
                            var eventoUrl = procesarURL(evento.url); // Obtener el URL procesado

                            if (eventoUrl.trim() == "#") {
                                eventoUrl = "javascript:void(0)";
                            } else {
                                eventoUrl = btoa(eventoUrl);
                            }

                            // Modificar el contenido de acuerdo al status del evento
                            var contenidoExtra = '';
                            if (evento.status === 'EN VIVO') {
                                contenidoExtra = '<span class="badge bg-success position-absolute top-0 start-0 zindex-2 mt-3 ms-3">En Vivo</span>';
                                contenidoIcon = "bx bxs-circle bx-flashing";
                            } else if (evento.status === 'FINALIZADO') {
                                contenidoExtra = '<span class="badge bg-danger position-absolute top-0 start-0 zindex-2 mt-3 ms-3">Finalizado</span>';
                                contenidoIcon = "bx bx-timer";
                            } else {
                                contenidoExtra = `<span class="badge bg-info position-absolute top-0 start-0 zindex-2 mt-3 ms-3">${evento.status}</span>`;
                                contenidoIcon = "bx bxs-time";
                            }
                            card.innerHTML = `
                    <article class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0"
                                aria-label="Course link"></a>
                            ${contenidoExtra}
                            <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3"
                                data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites"
                                data-bs-original-title="Save to Favorites">
                                <i class="bx bx-bookmark"></i>
                            </a>
                            <img src="${evento.img}" class="card-img-top" alt="${evento.league}">
                        </div>
                        <div class="card-body pb-3">
                            <h3 class="h5 mb-2">
                                <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}">${evento.title}</a>
                            </h3>
                            <p class="fs-sm mb-2">${evento.league}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                            <div class="d-flex align-items-center me-4">
                                <i class="${contenidoIcon} fs-xl me-1"></i>
                                ${evento.status}
                            </div>
                        </div>
                    </article>
                `;
                            eventosContainer.appendChild(card);
                        });
                    })
                    .catch(error => {
                        // Manejar los errores de la solicitud
                        console.error("Error al obtener el JSON:", error);
                    });
            });


        </script>
    </div>
</section>