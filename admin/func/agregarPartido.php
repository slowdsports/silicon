<!--Basic Modal -->
<div class="modal fade text-left" id="agregarPartido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">
                    Agregar Nuevo Partido
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
                                        <label for="equipoLocal">Local</label>
                                        <select id="equipoLocal" name="equipoLocal" class="choices form-select">
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/equipos.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $equipos = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($equipos as $equipo):
                                                $teams[] = $equipo;
                                            endforeach; // Imprimir los resultados
                                            foreach ($teams as $team):
                                                // Teams
                                                $equipoId = $team['equipoId'];
                                                $equipoNombre = $team['equipoNombre'];
                                                $equipoPais = $team['ligaPais'];
                                                ?>
                                                <option id="<?= $equipoId ?>" name="<?= $equipoId ?>"
                                                    label="<?= $equipoNombre ?>" value="<?= $equipoId ?>">
                                                    <?= $equipoNombre ?> (<?= $equipoPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="equipoVisitante">Visitante</label>
                                        <select id="equipoVisitante" name="equipoVisitante" class="choices form-select">
                                            <?php foreach ($equipos as $equipo):
                                                $teams[] = $equipo;
                                            endforeach; // Imprimir los resultados
                                            foreach ($teams as $team):
                                                // Teams
                                                $equipoId = $team['equipoId'];
                                                $equipoNombre = $team['equipoNombre'];
                                                $equipoPais = $team['ligaPais'];
                                                ?>
                                                <option id="<?= $equipoId ?>" name="<?= $equipoId ?>"
                                                    label="<?= $equipoNombre ?>" value="<?= $equipoId ?>">
                                                    <?= $equipoNombre ?> (<?= $equipoPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoLiga">Liga</label>
                                        <select id="partidoLiga" name="partidoLiga" class="choices form-select">
                                            <?php
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/ligas.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $ligas = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            foreach ($ligas as $liga):
                                                $leagues[] = $liga;
                                            endforeach; // Imprimir los resultados
                                            foreach ($leagues as $league):
                                                // Teams
                                                $ligaId = $league['ligaId'];
                                                $ligaNombre = $league['ligaNombre'];
                                                $ligaPais = $league['ligaPais'];
                                                ?>
                                                <option id="<?= $ligaId ?>" name="<?= $ligaId ?>" label="<?= $ligaNombre ?>"
                                                    value="<?= $ligaId ?>" <?=($ligaId == $filtroLiga) ? "selected" : ""; ?>>
                                                    <?= $ligaNombre ?> (<?= $ligaPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoFecha">Fecha</label>
                                        <input class="form-control" type="datetime-local" name="partidoFecha"
                                            id="partidoFecha">
                                    </div>
                                </div>
                                <hr>
                                <h6>Canales:</h6>
                                <div class="form-group col-md-6 col-6">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <input type="checkbox" id="starp" name="starp" value="1"
                                                class="form-check-input" />
                                            <label for="starp">Star+</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <input type="checkbox" id="vix" name="vix" value="1"
                                                class="form-check-input" />
                                            <label for="vix" checked>Vix+</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal1">Canal 1</label>
                                        <select id="partidoCanal1" name="partidoCanal1" class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno
                                            </option>
                                            <?php
                                            // Autoincrement id Canales
                                            $cs = 1;
                                            // Leer el archivo JSON
                                            $json = file_get_contents('../json/canales.json');
                                            // Decodificar la cadena JSON en un array asociativo de PHP
                                            $canales = json_decode($json, true);
                                            // Crear un array para almacenar los resultados
                                            $resultados = array(); // Recorrer los datos
                                            $cs++; foreach ($canales as $canal):
                                                $listChannels[] = $canal;
                                            endforeach; // Imprimir los resultados
                                            foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>">
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal2) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal3) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal4) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal5) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal6) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal7) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal8) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal9) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="partidoCanal<?= $cs ?>">Canal <?= $cs ?></label>
                                        <select id="partidoCanal<?= $cs ?>" name="partidoCanal<?= $cs ?>"
                                            class="choices form-select">
                                            <option id="<?= $cs ?>" name="<?= $cs ?>" label="Ninguno" value="null">Ninguno</option>
                                            <?php
                                            $cs++; foreach ($listChannels as $channel):
                                                // Teams
                                                $canalId = $channel['canalId'];
                                                $canalNombre = $channel['canalNombre'];
                                                $canalPais = $channel['pais_canal'];
                                                ?>
                                                <option id="<?= $canalId ?>" name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>" value="<?= $canalId ?>"
                                                    <?=($canalId == $canal10) ? "selected" : ""; ?>>
                                                    <?= $canalNombre ?> (<?= $canalPais ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button id="auto" value="<?= $filtroLiga ?>" type="button"
                                        class="btn btn-primary me-1 mb-1" onclick="agregarPartido()">
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