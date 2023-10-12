<div class="container">
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="<?= base_url('uploads/') . $product->product_image; ?>"
                             alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                             data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php
                                        foreach ($images as $image) {
                                            ?>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                         src="<?= base_url('uploads/multiple/') . $image->products_image; ?>"
                                                         alt="Product Image 1">
                                                </a>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <!--/.Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php
                                        foreach ($images69 as $image) {
                                            ?>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                         src="<?= base_url('uploads/multiple/') . $image->name; ?>"
                                                         alt="Product Image 1">
                                                </a>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <!--/.Third slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?= $product->product_name; ?></h1>
                            <p class="h3 py-2">$<?= number_format($product->product_price, 0, ",", "."); ?></p>
                            <p class="py-2">
                                <span class="list-inline-item text-dark"></span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>Easy Wear</strong></p>
                                </li>
                            </ul>

                            <h6>Descripción:</h6>
                            <p><?= $product->product_description; ?></p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Avaliable Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>White / Black</strong></p>
                                </li>
                            </ul>
                            <h6>Specification:</h6>
                            <ul class="list-unstyled pb-3">
                                <?= $product->product_description; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Article -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="row text-left p-2 pb-3">
                    <h4>Productos Relacionados</h4>
                </div>

                <!-- Start Carousel Wrapper -->
                <div id="carousel-related-product" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $productChunks = array_chunk($products, 3); // Divide los productos en grupos de 3
                        foreach ($productChunks as $chunk) {
                            ?>
                            <div class="carousel-item <?php if ($chunk === reset($productChunks)) echo 'active'; ?>">
                                <div class="row">
                                    <?php
                                    foreach ($chunk as $product) {
                                        ?>
                                        <div class="col-md-4">
                                            <div class="product-wap card rounded-0">
                                                <div class="card rounded-0">
                                                    <img class="card-img rounded-0 img-fluid"
                                                         src="<?= base_url('uploads/') . $product->product_image; ?>">
                                                    <div
                                                        class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                                        <ul class="list-unstyled">
                                                            <!-- Agregar contenido de superposición aquí si es necesario -->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="<?php echo base_url('/'); ?><?= $product->product_url; ?>"
                                                       class="h3 text-decoration-none"><?= $product->product_name ?></a>
                                                    <p class="text-center mb-0">
                                                        $<?= number_format($product->product_price, 0, ",", "."); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-related-product" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-related-product" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
                <!-- End Carousel Wrapper -->
            </div>
        </div>
    </section>
</div>
