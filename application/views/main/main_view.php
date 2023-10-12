<div class="container">

    <?php
    foreach ($products as $product) {
        ?>
        <div class="card bg-light-subtle mt-3">
            <img src="<?= base_url('uploads/') . $product->product_image; ?>" class="card-img-top" alt="...">

            <div class="card-body">
                <div class="text-section">
                    <h5 class="card-title fw-bold"><?= $product->product_name; ?></h5>
                    <p class="card-text"><?= $product->product_description; ?></p>
                </div>
                <div class="cta-section">
                    <div>$129.00</div>
                    <a href="<?php echo base_url('/'); ?><?= $product->product_url; ?>" class="btn btn-dark">Buy Now</a>
                </div>
            </div>
        </div>

    <?php }
    ?>
    <div class="pagination d-flex justify-content-center">
        <?= $this->pagination->create_links(); ?>
    </div>

</div>
