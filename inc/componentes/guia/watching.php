<div class="container" id="contenedor-card">
</div>
<script>
// ID del canal cuyo JSON deseas consumir
//const canalId = 'hbo_argentina';
const canalId = '<?=$epg?>';

// Contenedor donde se insertará la tarjeta
const contenedorCard = document.getElementById('contenedor-card');

// Función para cargar y mostrar la programación en vivo del canal específico
function cargarProgramacion() {
    fetch(`inc/componentes/guia/json/${canalId}.json`)
        .then(response => response.json())
        .then(data => {
            const programaEnVivo = data.programas.find(programa => programa.en_vivo);

            if (programaEnVivo) {
                const card = document.createElement('div');
                card.className = 'row row-cols-1 row-cols-12 g-0';

                card.innerHTML = `
                    <div class="col d-flex align-items-center border-end-sm border-bottom p-3" style="max-width: 18rem; border-radius: 15px">
                        <img src="${programaEnVivo.imagen}" width="48" alt="Icon">
                        <div class="ps-2 ms-1">
                            <h3 class="h6 mb-0">${programaEnVivo.titulo}</h3>
                            <p class="fs-xs mb-0">Estás viendo</p>
                        </div>
                    </div>
                `;

                contenedorCard.appendChild(card);
            } else {
                contenedorCard.innerHTML = `<p>No hay un programa en vivo en este momento.</p>`;
            }
        })
        .catch(error => console.error('Error al cargar la programación:', error));
}

// Cargar la programación del canal específico
cargarProgramacion();
</script>
