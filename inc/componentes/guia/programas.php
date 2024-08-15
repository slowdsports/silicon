<?php
// Cargar el JSON
$jsonFile = 'inc/componentes/guia/json/programacion.json';
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

// Verificar si el JSON fue cargado y decodificado correctamente
if ($data === null) {
    die("Error al cargar o decodificar el archivo JSON.");
}
?>

<!-- HTML y Swiper -->
<div class="position-relative px-xl-5">

  <!-- Slider prev/next buttons -->
  <button type="button" id="prev-programs" class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex" aria-label="Previous">
    <i class="bx bx-chevron-left"></i>
  </button>
  <button type="button" id="next-programs" class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex" aria-label="Next">
    <i class="bx bx-chevron-right"></i>
  </button>

  <!-- Slider -->
  <div class="px-xl-2">
    <div class="swiper mx-n2" data-swiper-options='{
      "slidesPerView": 1,
      "loop": true,
      "pagination": {
        "el": ".swiper-pagination",
        "clickable": true
      },
      "navigation": {
        "prevEl": "#prev-programs",
        "nextEl": "#next-programs"
      },
      "breakpoints": {
        "500": {
          "slidesPerView": 2
        },
        "1000": {
          "slidesPerView": 3
        }
      }
    }'>
      <div class="swiper-wrapper">
        
        <?php foreach ($data as $canal => $programas): ?>
          <?php foreach ($programas as $programa): ?>
            <div class="swiper-slide h-auto pb-3">
              <article class="card h-100 border-0 shadow-sm mx-2">
                <div class="position-relative">
                  <a href="?p=tv&c=<?= $programa['canal']; ?>&f=<?= $programa['id']; ?>" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
                  <a href="javascript:void(0)" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-5 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Guardar (No Disponible)" aria-label="Guardar (No Disponible)">
                    <i class="bx bx-bookmark"></i>
                  </a>
                  <img src="<?= $programa['imagen']; ?>" class="card-img-top" alt="Image">
                </div>
                <div class="card-body pb-4">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="javascript:void(0)" class="badge fs-sm text-nav bg-secondary text-decoration-none"><?= $programa['categoria']; ?></a>
                    <span class="fs-sm text-muted">En Vivo</span>
                  </div>
                  <h3 class="h5 mb-0">
                    <a href="?p=tv&c=<?= $programa['canal']; ?>&f=<?= $programa['id']; ?>"><?= $programa['titulo'] ?></a>
                  </h3>
                  <p class="fs-sm"><?= $programa['descripcion'] ?></p>
                </div>
                <div class="card-footer py-4">
                  <a href="?p=tv&c=<?= $programa['canal']; ?>&f=<?= $programa['id']; ?>" class="d-flex align-items-center text-decoration-none">
                    <img src="assets/img/canales/<?= $programa['logo']?>.png" class="rounded-circle" width="48" alt="Avatar">
                    <div class="ps-3">
                      <h6 class="fs-base fw-semibold mb-0"><?= htmlspecialchars($programa['nombre']); ?></h6>
                      <span class="fs-sm text-muted">
                          <i class="flag <?= htmlspecialchars($programa['flag']); ?>"></i>
                          <?= strtoupper(htmlspecialchars($programa['pais'])); ?></span>
                    </div>
                  </a>
                </div>
              </article>
            </div>
          <?php endforeach; ?>
        <?php endforeach; ?>

      </div>

      <!-- Pagination (bullets) -->
      <div class="swiper-pagination position-relative bottom-0 mt-4 mb-lg-2"></div>
    </div>
  </div>
</div>

<script>
  // Inicializar Swiper
  var swiper = new Swiper('.swiper', JSON.parse(document.querySelector('.swiper').getAttribute('data-swiper-options')));
</script>
