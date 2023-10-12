</body>
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Pontevio</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        123 Consectetur at ligula 10660
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">info@pontevio.com</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Products | Servicios</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="<?php echo base_url('/Inmuebles') ?>" >Inmuebles</a></li>
                    <li><a class="text-decoration-none" href="#">Vehiculos</a></li>
                    <li><a class="text-decoration-none" href="#">Computación y electronica</a></li>
                    <li><a class="text-decoration-none" href="#">Moda, calzado, belleza y salud</a></li>
                    <li><a class="text-decoration-none" href="#">Hogar</a></li>
                </ul>
            </div>
            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Información  Adicional</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="#">Acerca de nosotros</a></li>
                    <li><a class="text-decoration-none" href="#">FAQs</a></li>
                    <li><a class="text-decoration-none" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-auto">
                <label class="sr-only" for="subscribeEmail">Dirección Electronica</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                    <div class="input-group-text btn-success text-light">Subscribe</div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2022 
                        | Diseñado por Galu
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>

<script src="<?php echo base_url('assets/node_modules/jquery/dist/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/node_modules/jquery-migrate/dist/jquery-migrate.js'); ?>"></script>
<script src="<?php echo base_url('/assets/node_modules/bootstrap/dist/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/templatemo.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
<script  src="<?php echo base_url('assets/js/slick.min.js'); ?>"></script>
<script>

    $('#category_id').change(function () {
        var category_id = $('#category_id').val();
        if (category_id !== '') {
            $.ajax({
                url: "<?php echo base_url(); ?>product/fetch_services",
                method: "POST",
                data: {
                    "category_id": category_id
                },
                success: function (data) {
                    $('#service_id').html(data);
                }
            });
        } else {
            $('#service_id').html('<option value="">Select State</option>');
        }
    });

    $('#region_id').change(function () {
        var region_id = $('#region_id').val();
        if (region_id !== '') {
            $.ajax({
                url: "<?php echo base_url(); ?>product/fetch_comunas",
                method: "POST",
                data: {
                    "region_id": region_id
                },
                success: function (data) {
                    $('#comuna_id').html(data);
                }
            });
        } else {
            $('#comuna_id').html('<option value="">Select Servicio</option>');
        }
    });

</script>
