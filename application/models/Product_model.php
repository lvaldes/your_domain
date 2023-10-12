<?php

class Product_model extends CI_Model {

    const ESTADO_ACTIVO = 'ACTIVO';

    public function getProducts() {

        $query = 'p.name as product_name,'
                . 'p.price as product_price,'
                . 'p.url as product_url,'
                . 'p.image as product_image,'
                . 'p.created_at as product_created_at,'
                . 'p.comuna_id as product_comuna,'
                . 'p.id as product_id,'
                . 'p.description as product_description,'
                . 'p.description_ as product_description_,'
                . 'p.image as product_image';

        $this->db->select($query);

        $this->db->order_by('id');
        $this->db->where('state', self::ESTADO_ACTIVO);
        $query = $this->db->get('product p');

        return $query->result();
    }

    public function obtener_registros_paginados($limit, $offset) {

        $this->db->select([
            'p.name as product_name',
            'p.price as product_price',
            'p.url as product_url',
            'p.image as product_image',
            'p.created_at as product_created_at',
            'c.name as product_comuna',
            'p.id as product_id',
            'p.description as product_description',
            'p.description_ as product_description_',
            'p.image as product_image'
        ]);

        $this->db->from('product p');  // Alias para la tabla principal
        $this->db->join('comuna c', 'p.comuna_id= c.id');
        $this->db->where('state', self::ESTADO_ACTIVO);
        $this->db->order_by('product_created_at', 'asc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function upload($data = array()) {

        return $this->db->insert_batch('image', $data);
    }

    public function get_nProducts() {

        return $this->db->count_all('product');
    }

    public function getProductsByOrderId($id) {

        $this->db->join('product_order', 'product_order.product_id = product.id');
        $this->db->join('order', 'product_order.order_id = order.id');
        $this->db->select('product.nome, product.sku, product.preco, product_order.product_qtd');
        $this->db->order_by('product.id');
        $this->db->where('product_order.order_id', $id);
        $this->db->where('order.state', 1);
        $query = $this->db->get('product');
        return $query->result();
    }

    public function getProductById($id) {

        $this->db->where('id', $id);
        $this->db->where('state', 1);
        $query = $this->db->get('product');
        return $query->row();
    }

    //obtiene solo el objeto con ese name, el name siempre sera unico //
    public function getProductByNombre($name) {

        $this->db->where('name', $name);
        $this->db->where('state', 1);
        $query = $this->db->get('product');
        return $query->row();
    }

    //obtiene solo el objeto con ese name, el name siempre sera unico //
    public function getProductByCategory($category_id) {

        $this->db->where('category_id', $category_id);
        $this->db->where('state', 1);
        $query = $this->db->get('product');
        return $query->result();
    }

    public function getProductsXProduct_description_($description_) {

        $this->db->select('p.name as product_name,'
                . 'p.id as product_id,'
                . 'p.price as product_price,'
                . 'p.image as product_image,'
                . 'p.description as product_description,'
                . 'p.description_ as product_description_');

        $this->db->where('description_', $description_);
        $this->db->where('state', 'ACTIVO');
        $query = $this->db->get('product p');
        return $query->row();
    }

    /* obtener las imagenes de productos */

    public function getProductsImagesXProduct_description_($description_) {

        $sql = "SELECT 
                p.name as product_name, 
                p.id as product_id, 
                p.price as product_price, 
                p.description as product_description, 
                p.description_ as product_description_,
                p.especificacion as product_especificacion,
                i.name as products_image 
                FROM product p 
                JOIN image i 
                ON p.id = i.product_id 
                WHERE description_ = '$description_' 
                AND state = 1";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function createProduct($form_data) {

        $this->db->insert('product', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function createVisita($form_data) {

        $this->db->insert('visita', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function updateProduct($form_data) {

        $this->db->where('id', $form_data['id']);
        $this->db->update('product', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteProduct($id) {

        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->update('product');
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function fetch_data($service_id) {

        $this->db->select("*");
        $this->db->where('service_id', $service_id);
        $this->db->from("product");
        return $this->db->get();
    }

    public function getProductsXCategory_name($category_name) {


        $sql = "SELECT p.name as product_name, p.id as product_id, p.url as product_url, p.image as product_image, 
p.price as product_price, p.comuna_id as product_comuna, p.description as product_description, 
p.description_ as product_description_, p.image as product_image 
FROM product p 
JOIN category c 
ON p.category_id = c.id 
WHERE c.name_ = '$category_name' ORDER BY p.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getProductsXService_name($service_name) {


        $sql = "
SELECT     p.name as product_name, p.id as product_id,    p.url as product_url,     p.image as product_image, 
p.price as product_price,
p.comuna_id as product_comuna,
p.description as product_description,
p.description_ as product_description_,
c.name as category_name,
p.image as product_image
                FROM product p
            JOIN service s
            ON p.service_id = s.id 
            JOIN category c
            ON p.category_id = c.id

WHERE s.name_ = '$service_name' "
                . "ORDER BY p.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function fetch_product_condition($path, $condition) {

        if ($path == "/pontevio/" && $condition == "Precio más bajo") {
            $this->db->select('p.name as product_name,'
                    . 'p.price as product_price');
            $this->db->order_by('product_price', "asc");
            $query = $this->db->get('product p');
        }
        if ($path == "/pontevio/" && $condition == "Precio más alto") {
            $this->db->select('p.name as product_name,'
                    . 'p.price as product_price');
            $this->db->order_by('product_price', "desc");
            $query = $this->db->get('product p');
        }

        if ($path == "/pontevio/" && $condition == "Ordenar Avisos por los más recientes") {
            $this->db->select('p.name as product_name,'
                    . 'p.created_at as product_created_at,'
                    . 'p.price as product_price');
            $this->db->order_by('product_created_at', "asc");
            $query = $this->db->get('product p');
        }


        $output = "";
        foreach ($query->result() as $row) {
            $output = $output . '   <div class="col-md-4">    <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="http://localhost/pontevio/uploads/wm_img_4560620a463b4c26acc6a5a9918be389.jpg">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="http://localhost/pontevio/Vehiculos/motos/hola_hola_hola" class="h3 text-decoration-none"><b>Camioneta roja poco uso</b></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>hola hola hola</li>
                                    <li>8</li>

                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <p class="text-center mb-0">' . number_format($row->product_price, 0, ",", ".") . '</p>
 </div>
                            </div>
                        </div>';
        }
        return $output;
    }

}
