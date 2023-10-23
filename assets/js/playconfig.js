// TEATRO //
const expandirCheckbox = document.getElementById("expandirBtn");
const reproductorColumna = document.getElementById("playerCol");
const chatColumna = document.getElementById("chatCol");

// Función para expandir o retraer las columnas según el estado del checkbox
function expandirColumnas() {
    const estaExpandido = expandirCheckbox.checked;

    // Cambiar las clases de las columnas según el estado del checkbox
    if (estaExpandido) {
        // Expandir las columnas
        reproductorColumna.classList.remove("col-lg-9");
        reproductorColumna.classList.add("col-lg-12");
        chatColumna.classList.remove("col-lg-3");
        chatColumna.classList.add("col-lg-12");
    } else {
        // Retraer las columnas
        reproductorColumna.classList.remove("col-lg-12");
        reproductorColumna.classList.add("col-lg-9");
        chatColumna.classList.remove("col-lg-12");
        chatColumna.classList.add("col-lg-3");
    }

    // Guardar el estado del checkbox en LocalStorage
    localStorage.setItem("columnasExpandidas", estaExpandido);
}

// Verificar si el usuario ya ha hecho una elección anteriormente
const estaExpandido = JSON.parse(localStorage.getItem("columnasExpandidas"));
if (estaExpandido) {
    // Si las columnas estaban expandidas, marcar el checkbox como seleccionado y expandir las columnas
    expandirCheckbox.checked = true;
    expandirColumnas();
}

// Agrega un evento de cambio al checkbox para llamar a la función cuando se cambia su estado
expandirCheckbox.addEventListener("change", expandirColumnas);


// CHAT //
const twitchChat = document.getElementById('twitch-chat-embed');
const telegramPost = document.getElementById('telegram-post');
const themeSwitch = document.querySelector('[data-bs-toggle="mode"]');
const checkbox = themeSwitch.querySelector('.form-check-input');

// Función para cambiar el modo del chat de Twitch
function toggleChatMode() {
    const isDarkMode = checkbox.checked;
    //const chatMode = isDarkMode ? 'darkpopout' : '';
    //twitchChat.src = `https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&parent=localhost&${chatMode}`;
    const chatMode = isDarkMode ? 'dark=1' : '';
    twitchChat.src = `https://comments.app/embed/view?website=c5_L7xYi&page_url=https%3A%2F%2Firtvhn.info%2F%3Fp%3Dtv%26c%3D1%26f%3D7&origin=https%3A%2F%2Firtvhn.info&page_title=iRaffle%20TV%20%7C%20Televisi%C3%B3n%20Gratis%20por%20Internet&limit=25&color=F646A4&colorful=1&dislikes=1&height=560&${chatMode}`;

    // Guardar la preferencia del usuario en localStorage
    window.localStorage.setItem('chatMode', chatMode);
}

// Configurar el evento clic para cambiar el modo del chat de Twitch
themeSwitch.addEventListener('click', toggleChatMode);

// Cargar el chat con la preferencia del usuario desde localStorage
const savedChatMode = window.localStorage.getItem('chatMode');
if (savedChatMode) {
    //twitchChat.src = `https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&${savedChatMode}`;
    //checkbox.checked = savedChatMode === 'darkpopout';
    twitchChat.src = `https://comments.app/embed/view?website=c5_L7xYi&page_url=https%3A%2F%2Firtvhn.info%2F%3Fp%3Dtv%26c%3D1%26f%3D7&origin=https%3A%2F%2Firtvhn.info&page_title=iRaffle%20TV%20%7C%20Televisi%C3%B3n%20Gratis%20por%20Internet&limit=25&color=F646A4&colorful=1&dislikes=1&height=560&${savedChatMode}`;
    checkbox.checked = savedChatMode === 'dark=1';
} else {
    // Si no hay preferencia guardada, cargar el chat con el modo predeterminado
    toggleChatMode();
}


// Función para cambiar el modo del post de Telegram
function togglePostMode() {
    const isDarkMode = checkbox.checked;
    const postMode = isDarkMode ? 'dark=1' : '';
    telegramPost.src = `https://t.me/iraffle_tv/3?embed=1&color=6366F1&${postMode}`;

    // Guardar la preferencia del usuario en localStorage
    window.localStorage.setItem('postMode', postMode);
}
themeSwitch.addEventListener('click', togglePostMode);

// Cargar el post con la preferencia del usuario desde localStorage
const savedPostMode = window.localStorage.getItem('postMode');
if (savedPostMode) {
    telegramPost.src = `https://t.me/iraffle_tv/3?embed=1&color=6366F1&${savedPostMode}`;
    checkbox.checked = savedPostMode === 'dark=1';
} else {
    // Si no hay preferencia guardada, cargar el chat con el modo predeterminado
    togglePostMode();
}