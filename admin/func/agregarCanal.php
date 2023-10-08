<!--Basic Modal -->
<div class="modal fade text-left" id="agregarCanal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">
                    Agregar Nuevo Canal
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
                                        <label for="canalNombre">Nombre</label>
                                        <input class="form-control" type="text" name="canalNombre" id="canalNombre">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalImg">Logo</label>
                                        <input class="form-control" type="text" name="canalImg" id="canalImg">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalUrl">URL</label>
                                        <input class="form-control" type="text" name="canalUrl" id="canalUrl">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalKey">Key</label>
                                        <input class="form-control" type="text" name="canalKey" id="canalKey">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalKey2">Key2</label>
                                        <input class="form-control" type="text" name="canalKey2" id="canalKey2">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalCategoria">Categoría</label>
                                        <select id="canalCategoria" name="canalCategoria" class="choices form-select">
                                            <option value="null">Ninguno</option>
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/categorias.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $categorias = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($categorias as $categoria):
                                                $categories[] = $categoria;
                                            endforeach; foreach ($categories as $category):
                                                $categoriaId = $category['categoriaId'];
                                                $categoriaNombre = $category['categoriaNombre'];
                                                // Imprimir los resultados
                                                ?>
                                                <option id="<?= $categoriaId ?>" name="<?= $categoriaId ?>"
                                                    label="<?= $categoriaNombre ?>" value="<?= $categoriaId ?>">
                                                    <?= $categoriaNombre ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalPais">País</label>
                                        <select id="canalPais" name="canalPais" class="choices form-select">
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
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="canalTipo">Tipo</label>
                                        <select id="canalTipo" name="canalTipo" class="choices form-select">
                                            <option value="null">Ninguno</option>
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/tipos.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $tipos = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($tipos as $tipo):
                                                $types[] = $tipo;
                                            endforeach;
                                            foreach ($types as $type):
                                                $tipoCodigo = $type['tipoId'];
                                                $tipoNombre = $type['tipoNombre'];
                                                // Imprimir los resultados
                                                ?>
                                                <option id="<?= $tipoCodigo ?>" name="<?= $tipoCodigo ?>"
                                                    label="<?= $tipoNombre ?>" value="<?= $tipoCodigo ?>">
                                                    <?= $tipoNombre ?> (<?= $tipoCodigo ?>)
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