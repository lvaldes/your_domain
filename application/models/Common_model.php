<?php

class Common_model extends CI_Model {

    public function insert($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function edit_option($action, $id, $table) {
        $this->db->where('id', $id);
        $this->db->update($table, $action);
        return;
    }

    function update($action, $id, $table) {
        $this->db->where('id', $id);
        $this->db->update($table, $action);
        return;
    }

    function update_state($form_data) {
        $this->db->where('key', $form_data['key']);
        $this->db->update('login', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function delete($id, $table) {
        $this->db->delete($table, array('id' => $id));
        return;
    }

    function delete_user_role($id, $table) {
        $this->db->delete($table, array('user_id' => $id));
        return;
    }

    function select($table) {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id', 'ASC');
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function select_option($id, $table) {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function check_power($type) {
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    public function check_email($email) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_exist_power($id) {
        $this->db->select('*');
        $this->db->from('user_power');
        $this->db->where('power_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    //-- get all power
    function get_all_power($table) {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id', 'ASC');
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function get_user_info() {
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c', 'c.id = u.country', 'LEFT');
        $this->db->where('u.id', $this->session->userdata('id'));
        $this->db->order_by('u.id', 'DESC');
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function get_single_user_info($id) {
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c', 'c.id = u.country', 'LEFT');
        $this->db->where('u.id', $id);
        $this->db->get();
        $query = $query->row();
        return $query;
    }

    function get_user_role($id) {
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $id);
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function get_all_user() {
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('user u');
        $this->db->join('country c', 'c.id = u.country', 'LEFT');
        $this->db->order_by('u.id', 'DESC');
        $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    function get_user_total() {
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(user.id) FROM user   WHERE (user.status = 1) ) AS active_user', TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.status = 0)
                            )
                            AS inactive_user', TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.role = "admin")
                            )
                            AS admin', TRUE);
        $this->db->from('user');
        $this->db->get();
        $query = $query->row();
        return $query;
    }

    function upload_image($max_size) {

        //-- set upload path
        $config['upload_path'] = "./assets/images/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '92000';
        $config['max_width'] = '92000';
        $config['max_height'] = '92000';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload("photo")) {
            $data = $this->upload->data();

            //-- set upload path
            $source = "./assets/images/" . $data['file_name'];
            $destination_thumb = "./assets/images/thumbnail/";
            $destination_medium = "./assets/images/medium/";
            // Permission Configuration
            chmod($source, 0777);

            /* Resizing Processing */
            // Configuration Of Image Manipulation :: Static
            $this->load->library('image_lib');
            $img['image_library'] = 'GD2';
            $img['create_thumb'] = TRUE;
            $img['maintain_ratio'] = TRUE;

            /// Limit Width Resize
            $limit_medium = $max_size;
            $limit_thumb = 200;

            // Size Image Limit was using (LIMIT TOP)
            $limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'];

            // Percentase Resize
            if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                $percent_medium = $limit_medium / $limit_use;
                $percent_thumb = $limit_thumb / $limit_use;
            }

            //// Making THUMBNAIL ///////
            $img['width'] = $limit_use > $limit_thumb ? $data['image_width'] * $percent_thumb : $data['image_width'];
            $img['height'] = $limit_use > $limit_thumb ? $data['image_height'] * $percent_thumb : $data['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['thumb_marker'] = '_thumb-' . floor($img['width']) . 'x' . floor($img['height']);
            $img['quality'] = ' 100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_thumb;

            $thumb_nail = $data['raw_name'] . $img['thumb_marker'] . $data['file_ext'];
            // Do Resizing
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();

            ////// Making MEDIUM /////////////
            $img['width'] = $limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'];
            $img['height'] = $limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['thumb_marker'] = '_medium-' . floor($img['width']) . 'x' . floor($img['height']);
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_medium;

            $mid = $data['raw_name'] . $img['thumb_marker'] . $data['file_ext'];
            // Do Resizing
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //-- set upload path
            $images = 'assets/images/medium/' . $mid;
            $thumb = 'assets/images/thumbnail/' . $thumb_nail;
            unlink($source);

            return array(
                'images' => $images,
                'thumb' => $thumb
            );
        } else {
            echo "Failed! to upload image";
        }
    }

    public function getComunas($postData) {
        $response = array();
        $this->db->select('*');
        if ($postData['search']) {
            // Select record
            $this->db->where("comuna like '%" . $postData['search'] . "%' ");
            $records = $this->db->get('comuna')->result();
            foreach ($records as $row) {
                $response[] = array("value" => $row->id, "label" => $row->comuna);
            }
        }
        return $response;
    }

    public function getServicios($postData) {
        $response = array();
        $this->db->select('*');
        if ($postData['search']) {
            // Select record
            $this->db->where("nombre like '%" . $postData['search'] . "%' ");
            $records = $this->db->get('servicio')->result();
            foreach ($records as $row) {
                $response[] = array("value" => $row->id, "label" => $row->nombre);
            }
        }

        return $response;
    }

    public function getCategories() {
        $query = $this->db->get('category');
        return $query->result();
    }

    private function getCategoryByService($service_name) {
        $sql = "select c.name 'category_name' from category c inner join service s
  on c.id = s.category_id
  where s.name_ = '$service_name'";
        $query = $this->db->query($sql);
        if ($query->row()) {
            return $query->row();
        } return NULL;
    }

    public function getRegiones() {
        $query = $this->db->get('region');
        return $query->result();
    }

    public function getServicesByCategory_id($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('service');
        // print_r($query);
        return $query->result();
    }

    /* funcion que trae el nombre de la categoria segun id de la categoria */

    public function getCategoryByCategory_id($category_id) {
        $this->db->where('id', $category_id);
        $query = $this->db->get('category');
        return $query->row();
    }

    /* funcion que trae el nombre de la servicio segun id de la servicio */

    public function getServiceByService_id($service_id) {
        $this->db->where('id', $service_id);
        $query = $this->db->get('service');
        return $query->row();
    }

    function fetch_product_condition($param, $condition) {
        return $param;
    }

    function fetch_services($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->select('s.name_ as service_name_,'
                . 's.name as service_name,'
                . 's.id as service_id,'
                . 'c.name as category_name');
        $this->db->where('category_id', $category_id);
        $this->db->join('category c', 'c.id = s.category_id');
        $query = $this->db->get('service s');
        $output = '';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->service_id . '">' . $row->service_name . '</option>';
        }
        return $output;
    }

    public function fetch_comunas($region_id) {
        $this->db->select(
                'c.name as comuna_name,'
                . 'c.id as comuna_id'
        );
        $this->db->where('region_id', $region_id);
        $query = $this->db->get('comuna c');
        $output = '';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->comuna_id . '">' . $row->comuna_name . '</option>';
        }
        return $output;
    }

    public function getServices($category_id) {
        $this->db->select('s.name_ as service_name_,'
                . 's.name as service_name,'
                . 'c.name as category_name,'
                . 'c.name_ as category_name_'
        );
        $this->db->where('category_id', $category_id);
        $this->db->join('category c', 'c.id = s.category_id');
        $query = $this->db->get('service s');
        return $query->result();
    }

}
