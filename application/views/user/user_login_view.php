<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center text-dark mt-5">Ingresar</h2>
            <p class="text-center mb-5 text-dark">Accede a los servicios de Pontevio</p>
            <div class="card my-5">
                <?php echo form_open('user/login'); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" id="email" name="email" placeholder="Ingrese su email">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="card-footer bg-white">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #800000; width: 100%;">Ingresar</button>
                    <?php echo $this->session->flashdata('login_error'); ?>

				</div>

				<?php
                form_close();
                if (isset($errors)):
                    echo "<div class='alert alert-danger'>" . $errors . "</div>";
                endif;
                ?>
                <div class="card-footer text-center bg-white">
                    <p class="mb-0 text-dark">¿No tienes una cuenta? <a href="<?php echo base_url('registrar'); ?>" class="text-dark fw-bold">Crear una cuenta</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
