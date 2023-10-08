<!--Basic Modal -->
<div class="modal fade text-left" id="agregarLiga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">
                    Agregar Nueva Liga
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
                                        <label for="ligaId">ID</label>
                                        <input class="form-control" type="number" name="ligaId" id="ligaId">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="ligaNombre">Nombre</label>
                                        <input class="form-control" type="text" name="ligaNombre" id="ligaNombre">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="ligaImg">Logo</label>
                                        <input class="form-control" type="text" name="ligaImg" id="ligaImg">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="ligaPais">País</label>
                                        <select id="ligaPais" name="ligaPais" class="choices form-select">
                                            <option value="null">Ninguno</option>
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/paises.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $paises = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($paises as $pais):
                                                $countries[] = $pais;
                                            endforeach;
                                            foreach ($countries as $country):
                                                $paisCodigo = $country['paisCodigo'];
                                                $paisNombre = $country['paisNombre'];
                                                // Imprimir los resultados
                                                ?>
                                                <option id="<?= $paisCodigo ?>" name="<?= $paisCodigo ?>"
                                                    label="<?= $paisNombre ?>" value="<?= $paisCodigo ?>">
                                                    <?= $paisNombre ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button id="ligaAgregar" type="button"
                                        class="btn btn-primary me-1 mb-1" onclick="agregarLiga()">
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