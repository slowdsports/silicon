document.addEventListener("DOMContentLoaded", function () {
    var channelFilter = document.getElementById("channelFilter");
    var channelList = document.getElementById("channelList");
    var input = document.querySelector('.form-control');
    var channelOptionsDropdown = document.getElementById("channelOptions");
    var canalesContainer = document.getElementById("channels-container");
    var playerContainer = document.getElementById("player-container");

    // Ocultar elementos no necesarios inicialmente
    channelOptionsDropdown.classList.add("hidden");
    playerContainer.classList.add("hidden");
    // Redimensionar canales
    canalesContainer.classList.remove("col-md-4");
    canalesContainer.classList.add("col-12");
    // Obtener datos JSON a través del servidor PHP
    fetch("proxy.php")
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            // Obtener canales disponibles
            var channels = data.countries.reduce(function (acc, country) {
                return acc.concat(country.ambits.reduce(function (ambitAcc, ambit) {
                    return ambitAcc.concat(ambit.channels);
                }, []));
            }, []);

            // Obtener categorías disponibles
            categories = data.countries.reduce(function (acc, country) {
                return acc.concat(country.ambits.map(function (ambit) {
                    return ambit.name;
                }));
            }, []);

            // Mostrar todos los canales al inicio
            showChannels(channels);

            // Agregar las categorías al select
            categories.forEach(function (category) {
                var option = document.createElement("option");
                option.value = category;
                option.textContent = category;
                channelFilter.appendChild(option);
            });

            // Filtrar canales cuando cambie la opción del filtro
            channelFilter.addEventListener("change", function () {
                var selectedFilter = channelFilter.value;
                if (selectedFilter === "") {
                    showChannels(channels);
                } else {
                    var filteredChannels = channels.filter(function (channel) {
                        return channel.ambit.name === selectedFilter;
                    });
                    showChannels(filteredChannels);
                }
            });

            // Función para mostrar canales en la lista
            function showChannels(channels) {
                channelList.innerHTML = "";
                channels.forEach(function (channel) {
                    var card = document.createElement("div");
                    card.classList.add("card", "mb-3", "clickable-card", "col-6", "col-lg-1", "col-md-2", "col-sm-3");
                    card.style.cursor = "pointer";

                    var cardImage = document.createElement("img");
                    cardImage.classList.add("card-img-top");
                    cardImage.src = channel.logo;
                    cardImage.alt = channel.name;
                    card.setAttribute("data-name", channel.name);
                    card.setAttribute("data-bs-toggle", "tooltip");
                    card.setAttribute("data-bs-placement", "top");
                    card.setAttribute("data-bs-original-title", channel.name);
                    card.appendChild(cardImage);
                    channelList.appendChild(card);

                    var activeIframe = null;
                    // Asociar evento click para cambiar el contenido del reproductor
                    card.addEventListener("click", function () {
                        if (channel.options.length > 0) {
                            var videoSource = channel.options.find(function (option) {
                                return option.format === "stream" || option.format === "youtube";
                            });
                            // Asociar evento click para cambiar la fuente del reproductor
                            card.addEventListener("click", function () {
                                if (videoSource) {
                                    if (activeIframe) {
                                        activeIframe.remove();
                                    }
                                    if (videoSource.format === "stream") {
                                        // Si es un stream de Twitch, mostrar en un iframe
                                        var iframe = document.createElement("iframe");
                                        iframe.width = "100%";
                                        iframe.height = "400";
                                        iframe.src = videoSource.url + '&parent=127.0.0.1&parent=localhost&parent=irtvhn.info';
                                        iframe.allow = "autoplay; fullscreen";
                                        playerContainer.innerHTML = "";
                                        playerContainer.appendChild(iframe);
                                        activeIframe = iframe;
                                    } else if (videoSource.format === "youtube") {
                                        // Si es un enlace de YouTube, mostrar en un iframe
                                        var youtubeEmbedURL = videoSource.url.replace("watch?v=", "embed/");
                                        var iframe = document.createElement("iframe");
                                        iframe.width = "100%";
                                        iframe.height = "400";
                                        iframe.src = youtubeEmbedURL;
                                        iframe.allowFullscreen = true;
                                        playerContainer.innerHTML = "";
                                        playerContainer.appendChild(iframe);
                                        activeIframe = iframe;
                                    }
                                    // Mostrar selección de fuentes
                                    channelOptionsDropdown.classList.remove("hidden");
                                } else {
                                    if (activeIframe) {
                                        activeIframe.remove();
                                        activeIframe = null;
                                    }
                                    var playerInstance = jwplayer("videoPlayer");
                                    var videoSources = channel.options.map(function (option) {
                                        // Mostrar Player y redimensionar canales
                                        var cards = document.querySelectorAll('.clickable-card');
                                        cards.forEach(function (c) {
                                            c.classList.remove("col-6", "col-lg-1", "col-md-2");
                                        });
                                        playerContainer.classList.remove("hidden");
                                        canalesContainer.classList.remove("col-12");
                                        canalesContainer.classList.add("col-md-4");
                                        if (videoSources !== "") {
                                            // Mostrar selección de fuentes
                                            channelOptionsDropdown.classList.remove("hidden");
                                        } else {
                                            // Ocultar selección de fuentes
                                            channelOptionsDropdown.classList.add("hidden");
                                        }
                                        return { file: option.url, type: "hls" };
                                    });
                                    playerInstance.setup({
                                        sources: videoSources,
                                        autostart: true,
                                        controls: true,
                                        width: "100%",
                                        aspectratio: "16:9" // Puedes ajustar esto según las proporciones de tus videos
                                    });
                                }
                                // Nombre del Canal
                                var channelNameElement = document.getElementById("channelName");
                                channelNameElement.textContent = channel.name;
                                // Limpiar opciones anteriores
                                channelOptionsDropdown.innerHTML = "";

                                // Llenar el dropdown con las opciones de canal
                                channel.options.forEach(function (option, index) {
                                    var optionElement = document.createElement("option");
                                    optionElement.value = index; // Puedes usar el índice como valor para identificar la opción
                                    optionElement.textContent = "Opción " + (index + 1); // Puedes mostrar un texto descriptivo aquí si lo deseas
                                    channelOptionsDropdown.appendChild(optionElement);
                                });
                                // Alternar por fuentes
                                // Asociar evento change para cambiar la fuente del reproductor de video cuando se selecciona una opción del dropdown
                                channelOptionsDropdown.addEventListener("change", function () {
                                    var selectedOptionIndex = parseInt(channelOptionsDropdown.value, 10);
                                    var selectedOption = channel.options[selectedOptionIndex];
                                    if (selectedOption) {
                                        var playerInstance = jwplayer("videoPlayer");
                                        playerInstance.load([{ file: selectedOption.url, type: "hls" }]);
                                    }
                                });
                            });
                        }
                    });
                });
            }
            // Filtro Búsqueda
            var canales = document.querySelectorAll('.clickable-card');
            input.addEventListener('input', function () {
                var searchTerm = input.value.toLowerCase();
                canales.forEach(function (card) {
                    var cardName = card.getAttribute('data-name').toLowerCase();
                    if (cardName.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        })
        .catch(function (error) {
            console.error("Error fetching data: ", error);
        });
});