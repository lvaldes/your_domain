<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Publicar</h2>
            <div class="text-center mb-5 text-dark">Publica un producto o servicio en Pontevio</div>
            <div class="card my-5">
                <?php
                echo form_open_multipart('product/upload/' . (isset($product) ? $product->id : ''), array('role' => 'form'));
                if (isset($message)):
                    echo "<div class='alert alert-success'>" . $message . "</div>";
                endif;
                ?>
                <div class="mb-3">
                    <label for="region_id" class="form-label">Región</label>
                    <select class="form-select" name="region_id" id="region_id">
                        <option value="0">Selecciona una Región</option>
                        <?php foreach ($regiones as $row) : ?>
                            <option value="<?= $row->id ?>"><?= $row->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comuna_id" class="form-label">Comuna</label>
                    <select class="form-control" name="comuna_id" id="comuna_id">
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="nombre" required
                    value="<?= (isset($product) ? $product->name : '') ?>">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="precio" required
                    value="<?= (isset($product) ? $product->price : '') ?>">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select class="form-select" name="category_id" id="category_id">
                        <option value="0">Selecciona una Categoria</option>
                        <?php foreach ($categories as $row) : ?>
                            <option value="<?= $row->id ?>"><?= $row->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
				<div class="mb-3">
                    <label for="service_id" class="form-label">Servicio</label>
                    <select class="form-control" name="service_id" id="service_id">
                    </select>
                </div>
				  <div class="mb-3">
                    <label for="nombre" class="form-label">Descripción</label>
					<textarea name="description" id="description" class="form-control" rows="3" required="required"></textarea>
                </div>
				<div class="mb-3">
    				<label for="imagenPrincipal" class="form-label">Subir Imagen Principal</label>
    				<input class="form-control" type="file" name="userfile" id="imagenPrincipal">
				</div>
                <div class="mb-3">
                	<label for="imagenesAdicionales" class="form-label">Imágenes Adicionales</label>
    				<div class="input-group">
        				<input type="file" class="form-control" id="imagenesAdicionales" name="imagenes[]" multiple onchange="readURL(this)">
    				</div>
				</div>
				 <div class="text-center">
                    <input type="submit" value="Guardar" class="btn btn-primary">
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
