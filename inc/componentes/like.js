$(document).ready(function () {
    // Manejar el clic en el botón de "Like"
    $('.like-btn').on('click', function () {
        var canalId = $(this).data('canal-id');
        var likeCount = parseInt($('#like-count-' + canalId).text());

        // Verificar si el usuario ya ha dado "like" antes
        if ($(this).hasClass('active')) {
            // El usuario quiere eliminar su voto, restar 1 al recuento de votos
            likeCount -= 1;
            $(this).removeClass('active'); // Eliminar clase 'active' del botón
        } else {
            // El usuario está dando "like" por primera vez o cambiando su voto, sumar 1 al recuento de votos
            likeCount += 1;
            $(this).addClass('active'); // Agregar clase 'active' al botón
            // Si el botón de "Dislike" estaba activo, restar 1 al recuento de votos de "Dislike"
            if ($('.dislike-btn[data-canal-id="' + canalId + '"]').hasClass('active')) {
                var dislikeCount = parseInt($('#dislike-count-' + canalId).text());
                $('#dislike-count-' + canalId).text(dislikeCount - 1);
                $('.dislike-btn[data-canal-id="' + canalId + '"]').removeClass('active');
            }
        }

        // Enviar la solicitud AJAX para registrar el voto "like"
        $.ajax({
            url: 'inc/componentes/like.php',
            type: 'POST',
            data: {
                canal_id: canalId,
                voto: 'like'
            },
            success: function (response) {
                // Actualizar el recuento de votos en la interfaz de usuario
                $('#like-count-' + canalId).text(likeCount);
            }
        });
    });

    // Manejar el clic en el botón de "Dislike"
    $('.dislike-btn').on('click', function () {
        var canalId = $(this).data('canal-id');
        var dislikeCount = parseInt($('#dislike-count-' + canalId).text());

        // Verificar si el usuario ya ha dado "dislike" antes
        if ($(this).hasClass('active')) {
            // El usuario quiere eliminar su voto, restar 1 al recuento de votos
            dislikeCount -= 1;
            $(this).removeClass('active'); // Eliminar clase 'active' del botón
        } else {
            // El usuario está dando "dislike" por primera vez o cambiando su voto, sumar 1 al recuento de votos
            dislikeCount += 1;
            $(this).addClass('active'); // Agregar clase 'active' al botón
            // Si el botón de "Like" estaba activo, restar 1 al recuento de votos de "Like"
            if ($('.like-btn[data-canal-id="' + canalId + '"]').hasClass('active')) {
                var likeCount = parseInt($('#like-count-' + canalId).text());
                $('#like-count-' + canalId).text(likeCount - 1);
                $('.like-btn[data-canal-id="' + canalId + '"]').removeClass('active');
            }
        }

        // Enviar la solicitud AJAX para registrar el voto "dislike"
        $.ajax({
            url: 'inc/componentes/like.php',
            type: 'POST',
            data: {
                canal_id: canalId,
                voto: 'dislike'
            },
            success: function (response) {
                // Actualizar el recuento de votos en la interfaz de usuario
                $('#dislike-count-' + canalId).text(dislikeCount);
            }
        });
    });
});
