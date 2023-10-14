var playerInstance = jwplayer("player");
if (getTYPE == 1) {
    playerInstance.setup({
        playlist: [
            {
                sources: [
                    {
                        default: false,
                        type: "hls",
                        file: atob(getURL),
                        label: "0",
                    },
                ],
            },
        ],
        height: "100vh",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        mediaid: "player",
        mute: false,
        autostart: false,
        language: "es",
    });
} else if (getTYPE == 9 || getTYPE == 12) {
    var playlistItem = {
        sources: [
            {
                default: false,
                type: "dash",
                file: atob(getURL),
                drm: {
                    clearkey: { keyId: atob(getKEY), key: atob(getKEY2) },
                },
                label: "0",
            },
        ],
    };

    // Verificar si getIMG existe y agregarlo a la lista de reproducción
    if (typeof getIMG !== "undefined" && getIMG !== null) {
        playlistItem.image = getIMG;
    }


    playerInstance.setup({
        playlist: [playlistItem],
        height: "100vh",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        mediaid: "player",
        mute: false,
        autostart: false,
        language: "es",
    });
}
// Preview Hack
jwplayer().setMute(false);
jwplayer().setControls(true);
