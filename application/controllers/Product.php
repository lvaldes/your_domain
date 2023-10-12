<?php

/* Controlador Product: Controlador encargado de controlar los productos */
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model', 'product');
        $this->load->model('common_model', 'common');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'image_lib');
        $this->load->model('imagen_model', 'imagen');
    }

    public function index() {
        $data = array();
        $data['email'] = "";
        $user_id = $this->session->userdata('user_id');
        $data['products'] = $this->product->getProducts($user_id);
        $this->load->view('_partials/head', $data);
        $this->load->view('_partials/header', $data);
        $this->load->view('product/product_view', $data);
        $this->load->view('_partials/footer');
    }

    /* funcion que trae los servicios segun id de categoria */

    function fetch_services() {

        if ($this->input->post('category_id')) {
            echo $this->common->fetch_services($this->input->post('category_id'));
        }
    }

    function fetch_comunas() {

        if ($this->input->post('region_id')) {
            echo $this->common->fetch_comunas($this->input->post('region_id'));
        }
    }

    public function form($product_id = null) {

        $data = array();
        $data['service_name'] = "";
        $data['email'] = "";
        $data['categories'] = $this->common->getCategories();
        $data['regiones'] = $this->common->getRegiones();

        if ($product_id) {
            $data['product'] = $this->product->getProductById($product_id);
        }
        $data['email'] = "";
        $this->load->view('partials/head');
        $this->load->view('partials/header', $data);
        $this->load->view('product/product_form_view', $data);
        $this->load->view('partials/footer');
    }

    public function detail($product_description_ = null) {

        $data = array();
        if ($product_description_) {
            $data['product'] = $this->product->getProductBydescription_($product_description_);
            $data['images'] = $this->imagen->get_images(1);
        }


        $data['email'] = $this->session->userdata('email');
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('product/product_detail_view', $data);
    }

    public function getComunas() {

        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->product->getComunas($postData);
        echo json_encode($data);
    }

    public function getServicios() {

        // POST data
        $postData = $this->input->post();
        // get data
        $data = $this->product->getServicios($postData);
        echo json_encode($data);
    }

    public function save($id = null) {

        $form_data = array(
            'id' => $id,
            'sku' => $this->input->post('sku'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'fecha' => date('Y-m-d H:i:s')
        );

        if (!$id) {
            $send_form = $this->product->createProduct($form_data);
        } else {
            $send_form = $this->product->updateProduct($form_data);
        }

        if ($send_form) {
            $this->session->set_flashdata('mensagem', array('success', 'Animal guardado con exito!'));
            redirect('product');
        } else {
            $this->session->set_flashdata('mensagem', array('danger', 'Ops datos incorrectos!'));
            redirect('product/form');
        }
    }

    /* funcion que resuelve el ordenamiento del sitio mediante ajaz */

    public function fetch_product_condition() {

        echo $this->product->fetch_product_condition($this->input->post('path'), $this->input->post('condition'));
    }

    public function delete($id) {

        $delete = $this->product->deleteProduct($id);
        if ($delete) {
            $this->session->set_flashdata('mensagem', array('success', 'Produto borrado con exito!'));
            redirect('product');
        } else {
            $this->session->set_flashdata('mensagem', array('danger', 'Ops datos no encontrados!'));
            redirect('product');
        }
    }

    public function upload($id = null) {

        $imagenesData = count($_FILES['imagenes']['name']);
        $uploadData = [];

        $filename = md5(uniqid(rand(), true));
        $config = array(
            'upload_path' => 'uploads',
            'allowed_types' => "gif|jpg|png|jpeg",
            'file_name' => $filename
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $file_data = $this->upload->data();
            $data['file_dir'] = $file_data['file_name'];
            $data['date_uploaded'] = date('Y-m-d H:i:s');
            $data['message'] = "Imagen Subida";

            $url = $this->common->getCategoryByCategory_id($this->input->post('category_id'))->name_ . '/' .
                    $this->common->getServiceByService_id($this->input->post('service_id'))->name_ . '/' .
                    str_replace(' ', '_', $this->input->post('description'));

            $form_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'description_' => str_replace(' ', '_', $this->input->post('description')),
                'price' => $this->input->post('price'),
                'image' => 'wmd_img_' . $data['file_dir'],
                'created_at' => date('Y-m-d H:i:s'),
                'service_id' => $this->input->post('service_id'),
                'category_id' => $this->input->post('category_id'),
                'comuna_id' => $this->input->post('comuna_id'),
                'state' => 'PENDIENTE_APROBACION',
                'user_id' => $this->session->userdata('user_id'),
                'url' => $url
            );

            //Resize Image code
            $imgConfig = array();
            $imgConfig['image_library'] = 'gd2';
            $imgConfig['source_image'] = './uploads/' . $data['file_dir'];
            $imgConfig['create_thumb'] = FALSE;
            $imgConfig['maintain_ratio'] = TRUE;
            $imgConfig['new_image'] = './uploads/res_' . $data['file_dir'];
            $imgConfig['width'] = 150;
            $imgConfig['height'] = 75;
            $this->load->library('image_lib', $imgConfig);

            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }

            //Create Thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $data['file_dir'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            //crop andimage
            $imgConfig['image_library'] = 'gd2';
            $imgConfig['source_image'] = './uploads/' . $data['file_dir'];
            $imgConfig['new_image'] = './uploads/crop_' . $data['file_dir'];
            $imgConfig['height'] = '300';
            $imgConfig['width'] = '200';
            $imgConfig['x_axis'] = '150';
            $imgConfig['y_axis'] = '150';
            $this->load->library('image_lib', $imgConfig);
            $this->image_lib->initialize($imgConfig);

            if (!$this->image_lib->crop()) {
                echo $this->image_lib->display_errors();
            }

            //rotate an image using codeigniter 
            $imgConfig['image_library'] = 'gd2';
            $imgConfig['source_image'] = './uploads/' . $data['file_dir'];
            $imgConfig['height'] = '400';
            $imgConfig['width'] = '400';
            $imgConfig['rotation_angle'] = '90';
            $imgConfig['new_image'] = './uploads/rot_' . $data['file_dir'];
            $this->load->library('image_lib', $imgConfig);
            $this->image_lib->initialize($imgConfig);

            if (!$this->image_lib->rotate()) {
                echo $this->image_lib->display_errors();
            }

            //Text watermark image
            $imgConfig = array();
            $imgConfig['image_library'] = 'GD2';
            $imgConfig['source_image'] = './uploads/' . $data['file_dir'];
            $imgConfig['new_image'] = './uploads/wm_text_' . $data['file_dir'];
            $imgConfig['wm_text'] = 'Copyright 2016 - Programmer Blog';
            $imgConfig['wm_type'] = 'text';
            $imgConfig['wm_font_size'] = '16';

            $this->load->library('image_lib', $imgConfig);
            $this->image_lib->initialize($imgConfig);
            $this->image_lib->watermark();

            //Overlay watermark image
            $imgConfig = array();
            $imgConfig['image_library'] = 'GD2';
            $imgConfig['source_image'] = './uploads/' . $data['file_dir'];
            $imgConfig['wm_overlay_path'] = './uploads/transparente/transparente.png';
            $imgConfig['new_image'] = './uploads/wmd_img_' . $data['file_dir'];
            $imgConfig['wm_type'] = 'overlay';
            $this->load->library('image_lib', $imgConfig);
            $this->image_lib->initialize($imgConfig);
            $this->image_lib->watermark();

            if (!$id) {
                $send_form = $this->product->createProduct($form_data);
            } else {
                $send_form = $this->product->updateProduct($form_data);
            }
        }

        for ($i = 0; $i < $imagenesData; $i++):


            $_FILES['file']['name'] = $_FILES['imagenes']['name'][$i];
            $_FILES['file']['type'] = $_FILES['imagenes']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['imagenes']['tmp_name'][$i];
            $_FILES['file']['size'] = $_FILES['imagenes']['size'][$i];

            $config['upload_path'] = './uploads/multiple/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = '5000';
            $imgConfig['wm_overlay_path'] = './uploads/transparente/transparente.png';
            $imgConfig['wm_type'] = 'overlay';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->image_lib->watermark();

            if ($this->upload->do_upload('file')) {
                $fileData = $this->upload->data();
                $uploadData[$i]['name'] = $fileData['file_name'];
                $uploadData[$i]['product_id'] = $send_form;
            }

        endfor;

        if ($uploadData !== null) {

            $insert = $this->product->upload($uploadData);

            if ($insert) {
                redirect('/');
            } else {
                $data = array();
                $this->load->model('imagen_model', 'imagen');
                $data['uploaded_images'] = $this->imagen->get_images();
                $error = $this->upload->display_errors();
                $data['errors'] = $error;
                redirect('/');
            }
        }
    }

    function fetch() {
        $output = '';
        $query = '';
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->product->fetch_data($query);

        $output .= '
<!--Listado articulos-->
                <div id="articles">

                    <!--AÑADIR ARTICULOS VIA JS-->


  ';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '
  
<article class="article-item" id="article-template">
   <div class="image-wrap"><img src="' . base_url() . 'uploads/' . $row->imagen . '" alt="Paisaje" /> </div>
   <h2>' . $row->name . '</h2> <span class="date">  Hace 5 minutos   </span>
   <a href="' . base_url() . 'product/detail/' . $row->descripcion_ . '">' . $row->descripcion_ . '</a>
   <div class="clearfix"></div>
</article>
				
    ';
            }
        } else {
            $output .= '';
        } $output .= '</div>';
        echo $output;
    }

}
