<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Editar la fuente:
                    <?= $result['fuenteNombre'] ?> del canal:
                    <?= $result['canalNombre'] ?>
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <!-- LOCAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="local" class="form-label">Canal Padre</label>
                                <select class="form-control select2" data-toggle="select2" id="local" name="local">
                                    <?php
                                    $canales_query = "SELECT canalId, canalNombre FROM canales";
                                    $resultado_canales = mysqli_query($conn, $canales_query);
                                    while ($canal = mysqli_fetch_assoc($resultado_canales)):
                                        ?>
                                        <option value="<?= $canal['canalId'] ?>" <?= ($canal['canalId'] == $result['canal']) ? "selected" : "" ?>>
                                            <?= $canal['canalNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- DATOS FUENTE -->
                        <div class="col-lg-12">
                            <div class="card">
                                <h4 class="header-title">Datos de la Fuente</h4>
                            </div>
                        </div>
                        <!-- NOMBRE -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fuenteNombre" class="form-label">Nombre</label>
                                <input type="text" id="fuenteNombre" class="form-control">
                            </div>
                        </div>
                        <!-- URL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fuenteUrl" class="form-label">URL</label>
                                <input type="text" id="fuenteUrl" class="form-control">
                            </div>
                        </div>
                        <!-- KEY 1 -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="key1" class="form-label">Key 1</label>
                                <input type="text" id="key1" class="form-control">
                            </div>
                        </div>
                        <!-- KEY 2 -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="key2" class="form-label">Key 2</label>
                                <input type="text" id="key2" class="form-control">
                            </div>
                        </div>
                        <!-- PAIS -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="pais" class="form-label">País</label>
                                <select class="form-control select2" data-toggle="select2" id="pais" name="pais">
                                    <?php
                                    $paises_query = "SELECT paisId, paisNombre FROM paises";
                                    $resultado_paises = mysqli_query($conn, $paises_query);
                                    while ($pais = mysqli_fetch_assoc($resultado_paises)):
                                        ?>
                                        <option value="<?= $pais['paisId'] ?>">
                                            <?= $pais['paisNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- TIPOS -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-control select2" data-toggle="select2" id="tipo" name="tipo">
                                    <?php
                                    $tipos_query = "SELECT tipoId, tipoNombre FROM tipos";
                                    $resultado_tipos = mysqli_query($conn, $tipos_query);
                                    while ($tipo = mysqli_fetch_assoc($resultado_tipos)):
                                        ?>
                                        <option value="<?= $tipo['tipoId'] ?>">
                                            <?= $tipo['tipoNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button type="submit" id="editar" name="editar" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>