<?php

class Imagen_model extends CI_Model {

    public function getImagenes($cliente_nombre) {

        $this->db->order_by('id');
        $this->db->where('cliente_nombre', $cliente_nombre);
        $query = $this->db->get('imagen');
        return $query->result();
    }

    public function save_image($data) {

        $this->db->insert('image', $data);
    }

    public function get_images() {

        $this->db->from('image');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

}
