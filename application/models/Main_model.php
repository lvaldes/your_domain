<?php

Class Main_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function getAllPosts($userid) {

        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by("id", "asc");
        $postsquery = $this->db->get();
        $postResult = $postsquery->result_array();
        $posts_arr = array();
        foreach ($postResult as $post) {
            $id = $post['id'];
            $name = $post['name'];
            $description = $post['description'];
            $description_ = $post['description_'];
            $image = $post['image'];
            // User rating
            $this->db->select('rating');
            $this->db->from('product_rating');
            $this->db->where("user_id", $userid);
            $this->db->where("product_id", $id);
            $userRatingquery = $this->db->get();
            $userpostResult = $userRatingquery->result_array();
            $userRating = 0;
            if (count($userpostResult) > 0) {
                $userRating = $userpostResult[0]['rating'];
            }

            $this->db->select('ROUND(AVG(rating),1) as averageRating');
            $this->db->from('product_rating');
            $this->db->where("product_id", $id);
            $ratingquery = $this->db->get();
            $postResult = $ratingquery->result_array();
            $rating = $postResult[0]['averageRating'];

            if ($rating == '') {
                $rating = 0;
            }

            $posts_arr[] = array("id" => $id, "image" => $image, "name" => $name, "description" => $description, "description_" => $description_, "rating" => $userRating, "averagerating" => $rating);
        }

        return $posts_arr;
    }

}
