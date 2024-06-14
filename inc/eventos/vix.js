// Función para convertir una cadena JSON a base64 URL-safe
function jsonToBase64UrlSafe(jsonString) {
    return btoa(jsonString).replace(/\+/g, "-").replace(/\//g, "_").replace(/=+$/, "");
}

// Función para convertir las claves en base64 URL-safe
function convertKeysToBase64UrlSafe(key1, key2) {
    const obj = {};
    obj[key1] = key2;
    const jsonString = JSON.stringify(obj);
    return jsonToBase64UrlSafe(jsonString);
}

function eventos() {
    var x = Math.random().toString(36).substring(7);
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

    $.ajax({
        //url: "https://api.codetabs.com/v1/proxy/?quest=https://futbollibre.nu/tv2//star-plus/eventos.json?" + x,
        //url: "https://corsproxy.io/?https://maindota2.co/json/datos.json?" + x,
        url: "vix.json?" + x,
        type: "get",
        success: function (arr) {
            // Ordenar los eventos según su status
            arr.sort(function (a, b) {
                if (a.status === "EN VIVO") return -1;
                if (b.status === "EN VIVO") return 1;

                // Ordenar por formato "hora:minuto" si es aplicable
                if (a.status.match(/^\d{1,2}:\d{2}$/) && b.status.match(/^\d{1,2}:\d{2}$/)) {
                    return new Date("1970-01-01T" + a.status) - new Date("1970-01-01T" + b.status);
                }

                // Si no es EN VIVO ni formato "hora:minuto", ordenar por FINALIZADO
                if (a.status === "FINALIZADO") return 1;
                if (b.status === "FINALIZADO") return -1;

                // Otros casos
                return 0;
            });
            var content = "";

            for (var i = 0; i < arr.length; i++) {
                var obj = arr[i];

                // Integrar lógicas aquí
                var url = obj["url"];
                var title = obj["title"];
                console.log(url);

                if (url !== "#") {
                    url = url.replace("/embed/eventos/?r=", "");
                    var decodedUrl = atob(url);
                    // Reemplazar
                    var replacedUrl = decodedUrl.replace(/.*\.(?:html|php)\?get=/, "");
                    // Obtener el proxy
                    //var proxy = "<?= $proxy ?>";
                    // Hacer split en partes usando "&"
                    var urlParts = replacedUrl.split("&");
                    // Ordenar las partes
                    //var m3u8 = proxy + urlParts[0];
                    var m3u8 = urlParts[0];
                    m3u8 = m3u8.replace(/^https:\/\/node\.240025\.xyz\//, '');
                    console.log("m3u8: " + m3u8)
                    // Encriptar la imagen a MD5
                    var imagen = urlParts[1] + "&" + urlParts[2] + "&" + urlParts[3];
                    imagen = imagen.replace("img=", "");
                    var key1 = urlParts[1].replace("key=", "");
                    var key2 = urlParts[2].replace("key2=", "");
                    console.log(key1 + ":" + key2)
                    // Convertir las claves a base64 URL-safe
                    var keys = convertKeysToBase64UrlSafe(key1, key2);
                    console.log(keys);
                    // Reemplazar la URL
                    url = "chrome-extension://opmeopcambhfimffbomjgemehjkbbmji/pages/player.html#" + m3u8 + "?ck=" + keys;
                    console.log(url);
                }

                if (obj["status"] == "EN VIVO")
                    content += `
                <div class="col pb-1 pb-lg-3 mb-4 evento">
                    <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                            </a>
                            <span class="badge bg-success position-absolute top-0 start-0 zindex-2 mt-3 ms-3">${obj["status"]}</span>
                            <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites" data-bs-original-title="Save to Favorites">
                                <i class="bx bx-bookmark"></i>
                            </a>
                            <img src="${obj["img"]}" class="card-img-top" alt="${obj["title"]}">
                        </div>
                        <div class="card-body pb-3">
                            <h3 class="h5 mb-2">
                                <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}">${obj["title"]}
                                </a>
                            </h3>
                            <p class="fs-sm mb-2">${obj["description"]}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                            <div class="d-flex align-items-center me-4">
                                <i class="bx bxs-circle bx-flashing fs-xl me-1"></i>
                                ${obj["status"]}
                            </div>
                        </div>
                    </article>
                </div>
                `;
                else if (obj["status"] == "FINALIZADO")
                    content += `
                <div class="col pb-1 pb-lg-3 mb-4 evento">
                    <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                            </a>
                            <span class="badge bg-danger position-absolute top-0 start-0 zindex-2 mt-3 ms-3">${obj["status"]}</span>
                            <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites" data-bs-original-title="Save to Favorites">
                                <i class="bx bx-bookmark"></i>
                            </a>
                            <img src="${obj["img"]}" class="card-img-top" alt="${obj["title"]}">
                        </div>
                        <div class="card-body pb-3">
                            <h3 class="h5 mb-2">
                                <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}">${obj["title"]}
                                </a>
                            </h3>
                            <p class="fs-sm mb-2">${obj["description"]}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                            <div class="d-flex align-items-center me-4">
                                <i class="bx bx-timer fs-xl me-1"></i>
                                ${obj["status"]}
                            </div>
                        </div>
                    </article>
                </div>
                `;
                else
                    content += `
                    <div class="col pb-1 pb-lg-3 mb-4 evento">
                        <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                            </a>
                            <span class="badge bg-primary position-absolute top-0 start-0 zindex-2 mt-3 ms-3"><span class="t">${obj["status"]}</span> hs</span>
                            <a href="#" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Save to Favorites" data-bs-original-title="Save to Favorites">
                                <i class="bx bx-bookmark"></i>
                            </a>
                            <img src="${obj["img"]}" class="card-img-top" alt="${obj["title"]}">
                        </div>
                        <div class="card-body pb-3">
                            <h3 class="h5 mb-2">
                                <a href="javascript:void(0);" onclick="cargarReproductor('${url}')" data-title="${title}">${obj["title"]}
                                </a>
                            </h3>
                            <p class="fs-sm mb-2">${obj["description"]}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                            <div class="d-flex align-items-center me-4">
                                <i class="bx bx-timer fs-xl me-1"></i>
                                Aún no comienza
                            </div>
                        </div>
                    </article>
                </div>
                `;
            }

            $("#eventos").html(content);

            guardaHorario();
            dT();
        },
    });
}

eventos();
function cargarReproductor(url) {
    var iframe = document.getElementById("embed-player");
    var playing = document.getElementById("eventos");
    var seccionPlayer = document.getElementById("repro");
    var tituloElemento = document.getElementById("titulo-evento");
    var eventElement = document.querySelector(`a[href="javascript:void(0);"][onclick="cargarReproductor('${url}')"]`);
    var title = eventElement.getAttribute("data-title");
    // Actualiza el src del iframe con la URL del evento
    seccionPlayer.classList.remove("hidden");
    iframe.src = "inc/reproductor/starn.php?r=" + url;
    // Actualiza el título del evento
    tituloElemento.innerText = title;
    // Mostrar el iframe
    playing.classList.add("playing");
}

window.setInterval(function () {
    eventos();
}, 60000);