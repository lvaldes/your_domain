<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    private $msg;

    function __construct() {
        parent::__construct();
        $this->lang->load('msg');
        $this->load->library('form_validation');
        $this->load->model('common_model', 'common');
        $this->load->model('user_model', 'user');
        $this->load->model('product_model', 'product');
        $this->load->model('Main_model');
    }

    public function index() {
        $this->load->view('user/user_login_view');
    }

    public function logout() {
        $this->session->sess_destroy();
        $data = array();
        $data['service_name'] = "";
        $data['email'] = "";
        $data['products'] = $this->product->getProducts();
        $data['n_products'] = $this->product->get_nProducts();
        redirect('/');
    }

    function update_state($key) {
        $form_data = array(
            'state' => 1,
            'key' => $key
        );
        $this->common->update_state($form_data);
    }

    public function login() {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['service_name'] = "";
            $email = $this->session->userdata('user_name');
            $data['email'] = $email;
            $data['products'] = $this->product->getProducts();
            $data['n_products'] = $this->product->get_nProducts();
            $this->load->view('partials/head');
            $this->load->view('partials/header');
            $this->load->view('user/user_login_view', $data);
            $this->load->view('partials/footer');
        } else {

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('user', ['email' => $email])->row();
            if (!$user) {
                $this->session->set_flashdata('login_error', 'Pleaxxse check your email or password and try again.', 300);
                //redirect('www.google.cl');
            }

            if (password_verify($password, $user->password)) {
                $this->session->set_flashdata('login_error', 'Pleassssse check your email or password and try again.', 300);
                redirect(uri_string());
            }

            $data = array(
                'user_id' => $user->id,
                'first_name' => $user->name,
                'last_name' => $user->lastName,
                'email' => $user->email,
            );

            $this->session->set_userdata($data);

            redirect('/'); // redirect to home
            //echo 'Login success!'; exit;
        }
    }

    function login_form() {
        $data = array();
        $data['service_name'] = "";
        $data['email'] = "";
        $data['email'] = "";
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('main/main_view', $data);
        $this->load->view('partials/footer');
    }

    function register() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $data = array();
        $data['service_name'] = "";
        $data['email'] = "";
        $data['regiones'] = $this->common->getRegiones();
        $data['email'] = "";
        $this->load->view('partials/head');
        $this->load->view('partials/header');
        $this->load->view('user/user_register_view', $data);
        $this->load->view('partials/footer');
    }

    /* PENDIENTE
     * falta terminar este metodo para grabar usuarios nuevos */

    function registerProcess() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $form_data = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('email')),
            'name' => $this->input->post('name'),
            'lastName' => $this->input->post('lastName'),
            'state' => 0,
            'comuna_id' => $this->input->post('comuna_id'),
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->user->createUser($form_data);
    }

}
