<div class="container" id="contenedor-card">
</div>
<script>
// ID del canal cuyo JSON deseas consumir
const canalId = '<?=$epg?>';

// Contenedor donde se insertará la tarjeta
const contenedorCard = document.getElementById('contenedor-card');

// Función para cargar y mostrar la programación en vivo del canal específico
function cargarProgramacion() {
    const token = Math.random().toString(36).substring(2, 15);
    fetch('inc/componentes/guia/json/programacion.json?upd=${token}')
        .then(response => response.json())
        .then(data => {
            // Obtener la programación del canal específico
            const canalProgramacion = data[canalId];

            if (canalProgramacion && canalProgramacion.length > 0) {
                // Obtener el primer programa disponible del canal
                const programaEnVivo = canalProgramacion[0]; // Puedes cambiar esto para verificar más condiciones

                if (programaEnVivo) {
                    const card = document.createElement('div');
                    card.className = 'row row-cols-1 row-cols-12 g-0';

                    card.innerHTML = `
                        <div class="col d-flex align-items-center border-end-sm border-bottom p-3" style="max-width: 18rem; border-radius: 15px">
                            <img src="${programaEnVivo.imagen}" width="48" alt="Icon">
                            <div class="ps-2 ms-1">
                                <p class="fs-xs mb-0">Estás viendo</p>
                                <h3 class="h6 mb-0">${programaEnVivo.titulo}</h3>
                            </div>
                        </div>
                    `;

                    contenedorCard.appendChild(card);
                }
            } else {
                contenedorCard.innerHTML = `<p>No se encontró programación para el canal ${canalId}.</p>`;
            }
        })
        .catch(error => console.error('Error al cargar la programación:', error));
}

// Cargar la programación del canal específico
cargarProgramacion();
</script>
