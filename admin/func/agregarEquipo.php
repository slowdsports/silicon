<!--Basic Modal -->
<div class="modal fade text-left" id="agregarEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">
                    Agregar Nuevo Equipo
                </h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <form class="form">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="equipoId">ID</label>
                                        <input class="form-control" type="number" name="equipoId" id="equipoId">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="equipoNombre">Nombre</label>
                                        <input class="form-control" type="text" name="equipoNombre" id="equipoNombre">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="equipoImg">Logo</label>
                                        <input class="form-control" type="text" name="equipoImg" id="equipoImg">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="equipoLiga">Liga</label>
                                        <select id="equipoLiga" name="equipoLiga" class="choices form-select">
                                            <option value="null">Ninguno</option>
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/ligas.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $ligas = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($ligas as $liga):
                                                $leagues[] = $liga;
                                            endforeach; foreach ($leagues as $league):
                                                $ligaId = $league['ligaId'];
                                                $ligaNombre = $league['ligaNombre'];
                                                // Imprimir los resultados
                                                ?>
                                                <option id="<?= $ligaId ?>" name="<?= $ligaId ?>"
                                                    label="<?= $ligaNombre ?>" value="<?= $ligaId ?>">
                                                    <?= $ligaNombre ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button id="equipoAgregar" type="button" class="btn btn-primary me-1 mb-1"
                                        onclick="agregarEquipo()">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>
        </div>
    </div>
</div>