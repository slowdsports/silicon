<div id="contenedor-card" class="container mt-4"></div>
<script>
// ID del canal cuyo JSON deseas consumir
const canalId = 'hbo_argentina'; // Puedes cambiarlo por el ID del canal que desees

// Contenedor donde se insertará la tarjeta
const contenedorCard = document.getElementById('contenedor-card');

// Función para cargar y mostrar la programación en vivo del canal específico
function cargarProgramacion() {
    fetch(`test/json/${canalId}.json`)
        .then(response => response.json())
        .then(data => {
            const programaEnVivo = data.programas.find(programa => programa.en_vivo);

            if (programaEnVivo) {
                const card = document.createElement('div');
                card.className = 'card overflow-hidden mb-4';
                const imgUrl = programaEnVivo.imagen.replace("miniatura", "posters");
                const canalUrl = "";

                card.innerHTML = `
                    <div class="row g-0">
                        <div class="col-sm-4 bg-repeat-0 bg-size-contain" style="background-image: url(${imgUrl}); min-height: 12rem;"></div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title">Estás viendo: ${programaEnVivo.titulo}</h5>
                                <a class="btn btn-sm btn-primary disabled" href="${canalUrl}" target="_blank">Ver Programación (En desarrollo)</a>
                            </div>
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
