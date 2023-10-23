// TEATRO //
const expandirBtn = document.getElementById("expandirBtn");
const reproductorColumna = document.getElementById("playerCol");
const chatColumna = document.getElementById("chatCol");

// Función para expandir las columnas
function expandirColumnas() {
    // Verificar si las columnas ya están expandidas
    const estanExpandidas = reproductorColumna.classList.contains("col-lg-12");

    // Cambiar las clases de las columnas según el estado actual
    if (!estanExpandidas) {
        // Expandir las columnas
        reproductorColumna.classList.remove("col-lg-9");
        reproductorColumna.classList.add("col-lg-12");
        chatColumna.classList.remove("col-lg-3");
        chatColumna.classList.add("col-lg-12");

        // Cambiar el contenido del botón a "retractar"
        expandirBtn.innerHTML = '<i class="fas fa-compress"></i><span>Retractar</span>';
    } else {
        // Retraer las columnas
        reproductorColumna.classList.remove("col-lg-12");
        reproductorColumna.classList.add("col-lg-9");
        chatColumna.classList.remove("col-lg-12");
        chatColumna.classList.add("col-lg-3");

        // Cambiar el contenido del botón a "expandir"
        expandirBtn.innerHTML = '<i class="fas fa-expand"></i><span>Expandir</span>';
    }

    // Guardar la elección del usuario en LocalStorage
    localStorage.setItem("columnasExpandidas", !estanExpandidas);
}

// Verificar si el usuario ya ha hecho una elección anteriormente
const columnasExpandidas = JSON.parse(localStorage.getItem("columnasExpandidas"));
if (columnasExpandidas) {
    // Si las columnas estaban expandidas, expandirlas nuevamente
    expandirColumnas();
}

// Agrega un evento de clic al botón para llamar a la función cuando se hace clic
expandirBtn.addEventListener("click", expandirColumnas);


// CHAT //
const twitchChat = document.getElementById('twitch-chat-embed');
const themeSwitch = document.querySelector('[data-bs-toggle="mode"]');
const checkbox = themeSwitch.querySelector('.form-check-input');

// Función para cambiar el modo del chat de Twitch
function toggleChatMode() {
    const isDarkMode = checkbox.checked;
    const chatMode = isDarkMode ? 'darkpopout' : '';
    twitchChat.src = `https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&${chatMode}`;

    // Guardar la preferencia del usuario en localStorage
    window.localStorage.setItem('chatMode', chatMode);
}

// Configurar el evento clic para cambiar el modo del chat de Twitch
themeSwitch.addEventListener('click', toggleChatMode);

// Cargar el chat con la preferencia del usuario desde localStorage
const savedChatMode = window.localStorage.getItem('chatMode');
if (savedChatMode) {
    twitchChat.src = `https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&${savedChatMode}`;
    checkbox.checked = savedChatMode === 'darkpopout';
} else {
    // Si no hay preferencia guardada, cargar el chat con el modo predeterminado
    toggleChatMode();
}