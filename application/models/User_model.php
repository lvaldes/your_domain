<?php

class User_model extends CI_Model {

    private $login = 'login';

    function get_user($email, $password) {

        $this->db->limit(1);
        $this->db->where('email', $email);
        $query = $this->db->get('user u');
        if ($query->row()) {
            return $query->row();
        }
        return NULL;
    }

    public function insertChat($form_data) {

        $this->db->insert('message', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getUsersChat($user_id) {

        $this->db->distinct();
        $this->db->join('user u', 'u.id = m.post_by_user_id');
        $this->db->select('u.id id, post_by_user_id  post_by_user_id,'
                . 'name name');
        $this->db->where('u.id !=', $user_id);
        $query = $this->db->get('message  m');
        return $query->result();
    }

    public function getMessages($user_id, $id) {

        $sql = "
			SELECT
            u.id as id2,
            u.name name,
            post_by_user_id,
            message,
            m.created_at
            FROM message m
            join user u
            on u.id= m.post_by_user_id
            WHERE
            (user_id = '$user_id' and post_by_user_id ='$id') or
            (user_id = '$id' and post_by_user_id ='$user_id')
            ORDER BY m.created_at desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getMessages2($user_id) {

        $sql = "SELECT
            u.id as id2,
            u.name name,
            post_by_user_id,
            message,
            m.created_at
            FROM message m
            join user u
            on u.id= m.post_by_user_id
            WHERE
            (user_id = '$user_id') or
            (post_by_user_id ='$user_id')
            ORDER BY m.created_at desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function createUser($form_data) {

        $this->db->insert('user', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

}
