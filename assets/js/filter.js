document.addEventListener('DOMContentLoaded', function () {
    // Obtén la entrada de texto y la lista de tarjetas de canales
    var input = document.querySelector('.form-control');
    var canales = document.querySelectorAll('.canal');

    // Agrega un evento de entrada a la entrada de texto
    input.addEventListener('input', function () {
        var searchTerm = input.value.toLowerCase(); // Obtén el término de búsqueda en minúsculas

        // Itera sobre las tarjetas de canales y muestra/oculta según el término de búsqueda
        canales.forEach(function (card) {
            var channelName = card.querySelector('.card .card-title').textContent.toLowerCase(); // Obtén el nombre del canal en minúsculas
            if (channelName.includes(searchTerm)) {
                card.style.display = 'block'; // Muestra la tarjeta si el término de búsqueda está presente en el nombre del canal
            } else {
                card.style.display = 'none'; // Oculta la tarjeta si el término de búsqueda no está presente en el nombre del canal
            }
        });
    });
});
// Fake Player
var playerFake = document.getElementById("playerFake");
var playerContainer = document.getElementById("playerContainer");
var twitchChatEmbed = document.getElementById("twitch-chat-embed");

playerFake.addEventListener("click", function() {
    console.log("Click en player fake");
    playerContainer.classList.remove("hidden");
    twitchChatEmbed.classList.remove("hidden");
    playerFake.style.display = "none";
});
