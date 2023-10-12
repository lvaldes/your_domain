<?php

/* Controlador Main: controlador principal encargado de desplegar el listado y el detalle de productos */

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller {
    /* Revisado */

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model', 'common');
        $this->load->model('product_model', 'product');
        $this->load->library('pagination', 'spanish');
    }

    public function index() {
        $data = array();
        $data['service_name'] = "";
        $data['category_name'] = "";
        $email = $this->session->userdata('user_name');
        $data['email'] = $email;

        $pagina = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; // Número de página
        $config['base_url'] = base_url() . 'main/index'; // URL de la página
        $config['total_rows'] = $this->product->get_nProducts(); // Total de registros
        $config['per_page'] = 3; // Registros por página
        $this->pagination->initialize($config);
        $data['products'] = $this->product->obtener_registros_paginados($config['per_page'], $pagina);

        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('main/main_view', $data);
        $this->load->view('partials/footer');
    }

    public function service($service_name = null) {
        $data = array();
        $data['email'] = "";
        $data['service_name'] = $service_name;
        $data['services'] = $this->common->getServices();
        $data['products'] = $this->product->getProductsXService_name($service_name);
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('main/main_view', $data);
        $this->load->view('partials/footer');
    }

    /* metodo que controla la galeria de detalle del producto */

    public function detailProduct() {
        $data = array();
        $data['email'] = "";
        $data['product'] = $this->product->getProductsXProduct_description_($this->uri->segment(3));
        $data['products'] = $this->product->getProducts();
        $data['images'] = $this->product->getProductsImagesXProduct_description_($this->uri->segment(3));
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('main/main_detail_view', $data);
        $this->load->view('partials/footer');
    }

    /* metodo que controla el producto nivel general */

    public function categoryProduct($category_name = null) {

        $data = array();
        $data['category_name'] = $category_name;
        $data['service_name'] = "";
        $data['email'] = "";
        if ($category_name != null) {
            $data['products'] = $this->product->getProductsXCategory_name($category_name);
        }
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('main/main_view', $data);
        $this->load->view('partials/footer');
    }

    public function serviceProduct($service_name = null) {
        $data = array();
        $data['service_name'] = str_replace("_", " ", $service_name);
        $data['email'] = "";
        if ($service_name != null) {
            $data['products'] = $this->product->getProductsXService_name($service_name);
            $data['category_name'] = ($this->common->getCategoryByService($service_name))->category_name;
        }
        print_r($data);
        exit(0);
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('main/main_view', $data);
        $this->load->view('partials/footer');
    }

}
