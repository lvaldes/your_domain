    <div class="container">

	<div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Registrar Usuario</h2>
            <div class="text-center mb-5 text-dark">Accede a los servicios de Pontevio</div>
            <div class="card my-5">
                <?php
                echo form_open_multipart('user/registerProcess', array('role' => 'form'));
                if (isset($message)):
                    echo "<div class='alert alert-success'>" . $message . "</div>";
                endif;
                ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nombre" name="name"
							placeholder="Nombre" required
							value="<?= (isset($produto) ? $produto->nombre : '') ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido"
							required value="<?= (isset($produto) ? $produto->apellido : '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
							required value="<?= (isset($produto) ? $produto->apellido : '') ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono"
							required value="<?= (isset($produto) ? $produto->telefono : '') ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <select class="form-control" name="region_id" id="region_id">
					<option disabled selected value="">Selecciona una región</option>

                        <?php
                        foreach ($regiones as $row) {
                            echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <select class="form-control" name="provincia_id" id="provincia_id">
					<option disabled selected value="">Selecciona una provincia</option>

                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <select class="form-control" name="comuna_id" id="comuna_id">
					<option disabled selected value="">Selecciona una comuna</option>
                    </select>
                </div>

				<div class="card-footer bg-white">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #800000; width: 100%;">Ingresar</button>
                </div>
                    <?php
                form_close();
                if (isset($errors)):
                    echo "<div class='alert alert-danger'>" . $errors . "</div>";
                endif;
                ?>
            </div>
        </div>
    </div>
    </div>
