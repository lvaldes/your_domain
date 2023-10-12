<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Consulta, compra, contrata servicios </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <!--HOJA DE ESTILOS-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css" />

    </head>

    <body>
        <header id="header">
            <div class="center">
                <!-- LOGO -->
                <div id="logo">
                    <img src="<?php echo base_url(); ?>assets/image/account-customize-man.svg" class="app-logo"
                         alt="Logotipo" />
                    <span id="brand">
                        <strong>Servicios</strong> en Galu
                    </span>
                </div>

                <!-- MENU -->
                <nav id="menu">
                    <ul>
                        <li>
                            <a href="index.html">Inicio</a>
                        </li>
                        <li>
                            <a href="blog.html">Blog</a>
                        </li>
                        <li>
                            <a href="/servicio/auth">login</a>
                        </li>
                        <li>
                            <a href="/servicio/auth/logout">salir</a>
                        </li>
                    </ul>
                </nav>
                <!--LIMPIAR FLOTADOS-->
                <div class="clearfix"></div>
            </div>
        </header>

        <div id="slider" class="slider-big">
            <h1>Contrata, consulta, compra servicios</h1>
            <a href="#" class="btn-white">Ir al blog</a>
        </div>

        <div class="center">
            <section id="content">
                <h2 class="subheader">Pagina no reconocida</h2>

                <!--Listado articulos-->
                <div id="articles">
                    <div id="result"></div>

                    <!--AÑADIR ARTICULOS VIA JS-->

                </div>

            </section>

            <aside id="sidebar">
                <div id="nav-blog" class="sidebar-item">
                    <h3>Puedes hacer esto</h3>
                    <a href="#" class="btn btn-success">Crear artículo</a>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Buscar</span>
                        <input type="text" name="search_text" id="search_text" placeholder="Busqueda de Servicios"
                               class="form-control" />
                    </div>
                </div>
                <br />

        </div>



        <aside id="sidebar">
            <div id="nav-blog" class="sidebar-item">
                <h3>Puedes hacer esto</h3>
                <a href="#" class="btn btn-success">Crear artículo</a>
            </div>

            <div id="search" class="sidebar-item">
                <h3>Buscador</h3>
                <p>Encuentra el artículo que buscas</p>
                <form>
                    <input type="text" name="search" />
                    <input type="submit" name="submit" value="Buscar" class="btn" />
                </form>
            </div>
        </aside>

        <div class="clearfix"></div>
