<section id="wrapper">

    <div class="login-register" style="background-image:url(<?php echo base_url() ?>assets/images/background/login-register.jpg);">        
        <div class="login-box card">
            <div class="card-body">

                <?php if (isset($page) && $page == "logout"): ?>
                    <div class="alert alert-success hide_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> Logout Successfully &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif ?>

                <form class="form-horizontal form-material" id="login-form" action="<?php echo base_url('user/log'); ?>" method="post">
                    <h2 class="box-title m-b-40 text-center">Ingresar a PonteVio</h2>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="user_name" required="" placeholder="Username"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password"> 
                        </div>
                    </div><br>
                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="<?php echo base_url('admin/pages/recover') ?>" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> Forgot password? --></a>
                        </div>
                    </div>

                    <!-- CSRF token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                    <div class="form-group text-center m-t-50">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <!-- <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="<?php echo base_url('admin/pages/register') ?>" class="text-info m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div> -->
                </form>

                <form class="form-horizontal" id="recoverform" action="#">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recuperar contraseña</h3>
                            <p class="text-muted">¡Ingrese su correo electrónico y le enviaremos las instrucciones! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email"> 
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<form>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>