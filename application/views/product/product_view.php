<div class="container container-person mt-5 p-5">
    <?= write_message() ?>
    <h1>Avisos</h1>
    <div class="col-md-12 mb-3">
        <div class="row">
            <a class="btn btn-primary" href="<?= base_url('product/form/') ?>">Nuevo Aviso</a>
        </div>
    </div>
    <table id="product_table" class="table table-striped table-bordered table-responsive-sm" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($products) {
                foreach ($products as $product) {
                    ?>
                    <tr>
                        <td><?= $product->product_id ?></td>
                        <td><?= $product->product_name ?></td>
                        <td><img src="<?= base_url(); ?>uploads/<?= $product->product_image ?>" alt="Product Image" width="200" height="200"></td>

                        <td><a href="<?= base_url('product/form/' . $product->product_id) ?>">Edit</a></td>
                        <td><a class="delete-product" href="#" data-id="<?= base_url('product/delete/' . $product->product_id) ?>"
                               data-toggle="modal" data-target="#deleteProductModal">Delete</a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
            <td class="text-center" colspan="6">No hay animales</td>
        <?php } ?>
        </tbody>
    </table>
</div>
