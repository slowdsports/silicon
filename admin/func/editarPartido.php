<?php
$getId = $_GET['id'];
$partQuery = mysqli_query($conn, "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
            e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
            e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
            e3.ligaNombre AS partido_liga,
            c1.canalId AS id_canal1, c1.canalNombre AS nombre_canal1,
            p1.paisNombre AS pais_canal1,
            c2.canalId AS id_canal2, c2.canalNombre AS nombre_canal2,
            p2.paisNombre AS pais_canal2,
            c3.canalId AS id_canal3, c3.canalNombre AS nombre_canal3,
            p3.paisNombre AS pais_canal3,
            c4.canalId AS id_canal4, c4.canalNombre AS nombre_canal4,
            p4.paisNombre AS pais_canal4,
            c5.canalId AS id_canal5, c5.canalNombre AS nombre_canal5,
            p5.paisNombre AS pais_canal5,
            c6.canalId AS id_canal6, c6.canalNombre AS nombre_canal6,
            p6.paisNombre AS pais_canal6,
            c7.canalId AS id_canal7, c7.canalNombre AS nombre_canal7,
            p7.paisNombre AS pais_canal7,
            c8.canalId AS id_canal8, c8.canalNombre AS nombre_canal8,
            p8.paisNombre AS pais_canal8,
            c9.canalId AS id_canal9, c9.canalNombre AS nombre_canal9,
            p9.paisNombre AS pais_canal9,
            c10.canalId AS id_canal10, c10.canalNombre AS nombre_canal10,
            p10.paisNombre AS pais_canal10
            FROM partidos p
            JOIN equipos e1 ON p.local = e1.equipoId
            JOIN equipos e2 ON p.visitante = e2.equipoId
            JOIN ligas e3 ON p.liga = e3.ligaId
            LEFT JOIN canales c1 ON p.canal1 = c1.canalId
            LEFT JOIN paises p1 ON c1.canalPais = p1.paisId
            LEFT JOIN canales c2 ON p.canal2 = c2.canalId
            LEFT JOIN paises p2 ON c1.canalPais = p2.paisId
            LEFT JOIN canales c3 ON p.canal3 = c3.canalId
            LEFT JOIN paises p3 ON c1.canalPais = p3.paisId
            LEFT JOIN canales c4 ON p.canal4 = c4.canalId
            LEFT JOIN paises p4 ON c1.canalPais = p4.paisId
            LEFT JOIN canales c5 ON p.canal5 = c5.canalId
            LEFT JOIN paises p5 ON c1.canalPais = p5.paisId
            LEFT JOIN canales c6 ON p.canal6 = c6.canalId
            LEFT JOIN paises p6 ON c1.canalPais = p6.paisId
            LEFT JOIN canales c7 ON p.canal7 = c7.canalId
            LEFT JOIN paises p7 ON c1.canalPais = p7.paisId
            LEFT JOIN canales c8 ON p.canal8 = c8.canalId
            LEFT JOIN paises p8 ON c1.canalPais = p8.paisId
            LEFT JOIN canales c9 ON p.canal9 = c9.canalId
            LEFT JOIN paises p9 ON c1.canalPais = p9.paisId
            LEFT JOIN canales c10 ON p.canal10 = c10.canalId
            LEFT JOIN paises p10 ON c1.canalPais = p10.paisId
            WHERE id='$getId'
            ORDER BY
            fecha_hora asc
            ");
            while ($result = mysqli_fetch_array($partQuery)) :
    // Teams
    $index = $result['id'];
    $local = $result['equipo_local'];
    $local_id = $result['id_local'];
    $visitante = $result['equipo_visitante'];
    $visitante_id = $result['id_visitante'];
    $partido_liga = $result['liga'];
    $fecha = $result['fecha_hora'];
    $starp = $result['starp'];
    $vix = $result['vix'];
    $canal1 = $result["id_canal1"];
    $canal2 = $result["id_canal2"];
    $canal3 = $result["id_canal3"];
    $canal4 = $result["id_canal4"];
    $canal5 = $result["id_canal5"];
    $canal6 = $result["id_canal6"];
    $canal7 = $result["id_canal7"];
    $canal8 = $result["id_canal8"];
    $canal9 = $result["id_canal9"];
    $canal10 = $result["id_canal10"];
endwhile
?>

<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar
                        <?= $local ?> vs.
                        <?= $visitante ?>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>ID</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input class="form-control" type="text" name="partidoId" id="partidoId" value="<?=$index?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Local</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="equipoLocal" name="equipoLocal" class="choices form-select">
                                            <?php
                                            $tmQuery = mysqli_query($conn, "SELECT * FROM equipos
                                            INNER JOIN ligas ON equipos.equipoLiga = ligas.ligaId");
                                            while($team = mysqli_fetch_array($tmQuery)):
                                                // Teams
                                                $equipoId = $team['equipoId'];
                                                $equipoNombre = $team['equipoNombre'];
                                                $equipoPais = $team['ligaPais'];
                                                ?>
                                                <option
                                                id="<?= $equipoId ?>"
                                                name="<?= $equipoId ?>"
                                                label="<?= $equipoNombre ?>"
                                                value="<?= $equipoId ?>"
                                                <?= ($local_id == $equipoId) ? "selected" : ""; ?>>
                                                    <?= $equipoNombre ?> (<?= $equipoPais ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Visitante</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="equipoVisitante" name="equipoVisitante" class="choices form-select">
                                            <?php
                                            $tmQuery = mysqli_query($conn, "SELECT * FROM equipos
                                            INNER JOIN ligas ON equipos.equipoLiga = ligas.ligaId");
                                            while($team = mysqli_fetch_array($tmQuery)):
                                                // Teams
                                                $equipoId = $team['equipoId'];
                                                $equipoNombre = $team['equipoNombre'];
                                                $equipoPais = $team['ligaPais'];
                                                ?>
                                                <option
                                                id="<?= $equipoId ?>"
                                                name="<?= $equipoId ?>"
                                                label="<?= $equipoNombre ?>"
                                                value="<?= $equipoId ?>"
                                                <?= ($equipoId == $visitante_id) ? "selected" : ""; ?>>
                                                    <?= $equipoNombre ?> (<?= $equipoPais ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Liga</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select id="partidoLiga" name="partidoLiga" class="choices form-select">
                                            <?php
                                            $lgQuery = mysqli_query($conn, "SELECT * FROM ligas");
                                            while($league = mysqli_fetch_array($lgQuery)):
                                                // Teams
                                                $ligaId = $league['ligaId'];
                                                $ligaNombre = $league['ligaNombre'];
                                                $ligaPais = $league['ligaPais'];
                                                ?>
                                                <option
                                                id="<?= $ligaId ?>"
                                                name="<?= $ligaId ?>"
                                                label="<?= $ligaNombre ?>"
                                                value="<?= $ligaId ?>"
                                                <?= ($partido_liga == $ligaId) ? "selected" : ""; ?>>
                                                    <?= $ligaNombre ?> (<?= $ligaPais ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Fecha</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input class="form-control" type="datetime-local" name="partidoFecha" id="partidoFecha" value="<?=$fecha?>">
                                    </div>
                                    <hr>
                                    <h6>Canales:</h6>
                                    <div class="form-group col-md-6 col-6">
                                        <div class="form-check">
                                            <div class="checkbox">
                                            <input type="checkbox" id="starp" name="starp" value="1" class="form-check-input" <?= ($starp == 1) ? "checked" : ""; ?> />
                                            <label for="starp">Star+</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-6">
                                        <div class="form-check">
                                            <div class="checkbox">
                                            <input type="checkbox" id="vix" name="vix" value="1" class="form-check-input" <?= ($vix == 1) ? "checked" : ""; ?> />
                                            <label for="vix">Vix+</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal1">Canal 1</label>
                                            <select id="partidoCanal1" name="partidoCanal1" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                // Autoincrement id Canales
                                                $cs = 1;
                                                // Leer el archivo JSON
                                                $json = file_get_contents('../json/canales.json');
                                                // Decodificar la cadena JSON en un array asociativo de PHP
                                                $canales = json_decode($json, true);
                                                // Crear un array para almacenar los resultados
                                                $resultados = array(); // Recorrer los datos
                                                $cs++;
                                                foreach ($canales as $canal):
                                                    $listChannels[] = $canal;
                                                endforeach; // Imprimir los resultados
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal1) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal2) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal3) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal4) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal5) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal6) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal7) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal8) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal9) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="partidoCanal<?=$cs?>">Canal <?=$cs?></label>
                                            <select id="partidoCanal<?=$cs?>" name="partidoCanal<?=$cs?>" class="choices form-select">
                                                <option id="<?=$cs?>" name="<?=$cs?>" label="Ninguno" value="null">Ninguno</option>
                                                <?php
                                                $cs++;
                                                foreach ($listChannels as $channel):
                                                    // Teams
                                                    $canalId = $channel['canalId'];
                                                    $canalNombre = $channel['canalNombre'];
                                                    $canalPais = $channel['pais_canal'];
                                                    ?>
                                                    <option
                                                    id="<?= $canalId ?>"
                                                    name="<?= $canalId ?>"
                                                    label="<?= $canalNombre ?>"
                                                    value="<?= $canalId ?>"
                                                    <?= ($canalId == $canal10) ? "selected" : ""; ?>>
                                                        <?= $canalNombre ?> (<?= $canalPais ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button id="edit" value="<?=$filtroLiga?>" type="button" class="btn btn-primary me-1 mb-1" onclick="editarPartido()">
                                            Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Basic Horizontal form layout section end -->