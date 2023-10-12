<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
    <?php $this->load->view('_partials/head'); ?>
    <body>
        <?php $this->load->view('_partials/header'); ?>
    <body>

        <?php
        if ($imagenes) {
            foreach ($imagenes as $imagen) {
                ?>
                <div class="col-sm-4 col-xs-4"><img src="<?= base_url(); ?>user/<?= $imagen->cliente_nombre ?>/imagenes/<?= $imagen->nombre ?>" alt="Italian Trulli" width="200" height="200"></div>

                <?php
            }
        } else {
            ?>
        <td class="text-center" colspan="6">Não há produtos</td>
    <?php } ?>
</body>
</html>
