<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_item_stocks($unit_id = NULL) {
        $this->db->select('i.*, c.category_name, sc.sub_cate_name, s.balance, u.name_en as branch_name');
        $this->db->from('items i');
        $this->db->join('item_categories c', 'c.id=i.cat_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=i.sub_cat_id', 'LEFT');
        $this->db->join('item_stocks s', 's.item_id=i.id', 'LEFT');
        $this->db->join('units u', 'u.id=s.unit_id', 'LEFT');
        if ($unit_id) {
            $this->db->where('s.unit_id', $unit_id);
        }
        $this->db->order_by('i.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_items(){
        $this->db->select('i.*, c.category_name, sc.sub_cate_name, u.unit_name');
        $this->db->from('items i');
        $this->db->join('item_categories c', 'c.id=i.cat_id', 'LEFT');
        $this->db->join('item_sub_categories sc', 'sc.id=i.sub_cat_id', 'LEFT');
        $this->db->join('item_unit u', 'u.id=i.unit_id', 'LEFT');
        $this->db->order_by('i.id', 'ASC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_data() {
        $this->db->select('*');
        $this->db->from('items');
        $query = $this->db->get()->result();
        return $query;
    }


    public function get_info($id) {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('items');
        return TRUE;
    }

}
