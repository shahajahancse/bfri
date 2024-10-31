<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pass_model extends CI_Model {

   public function __construct() {
      parent::__construct();
   }

   public function get_pass($limit = 1000, $offset = 0, $status=NULL) {
      // result query
      $this->db->select('p.*, h.host_name, h.host_designation, u.first_name, u.phone, u.email');
      $this->db->from('pass p');
      $this->db->join('host_person h', 'h.id = p.host_id', 'LEFT');
      $this->db->join('users u', 'u.id=p.user_id', 'LEFT');
      $this->db->limit($limit);
      $this->db->offset($offset);        
      $this->db->order_by('id', 'DESC');
      if($status != NULL){
         $this->db->where('p.status', $status);
      }

      // if($this->input->get('name') != NULL){
      //    $this->db->like('first_name', $this->input->get('name'));
      // }
      // if($this->input->get('username') != NULL){
      //    $this->db->where('email', $this->input->get('username')); 
      // }
      // echo $this->db->last_query(); exit;
      $result['rows'] = $this->db->get()->result();

      // count query
      $q = $this->db->select('COUNT(*) as count');
      $this->db->from('pass');
      if($status != NULL){
         $this->db->where('status', $status);
      }
      // if($this->input->get('name') != NULL){
      //    $this->db->like('first_name', $this->input->get('name'));
      // }
      // if($this->input->get('username') != NULL){
      //    $this->db->where('email', $this->input->get('username')); 
      // }
      $tmp = $this->db->get()->result();
      $result['num_rows'] = $tmp[0]->count;

      return $result;
   }

   public function get_info($id) {
        $this->db->select('p.*, h.host_name, u.first_name, u.phone, u.email');
        $this->db->from('pass p');
        $this->db->join('host_person h', 'h.id = p.host_id', 'LEFT');
        $this->db->join('users u', 'u.id=p.user_id', 'LEFT');
        $this->db->where('p.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

   public function get_host_person() {
      // count query
      $this->db->select('*');
      $this->db->from('host_person');
      $query = $this->db->get()->result();

      return $query;
   }

   public function get_host_person_info($id) {
      $query = $this->db->from('host_person')->where('id', $id)->get()->row();
      return $query;
   }

   public function get_dd_host_persons(){
      $data[''] = '-- Select Host Person --';
      $this->db->select('id, CONCAT(host_name, " (",host_designation," )") as text');
      $this->db->from('host_person');
      // $this->db->order_by('task_name_en', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['text'];
      }

      return $data;
   }
   

   public function user_destroy($id) {        
      $query = $this->db->delete('users', array('id' => $id));
      return $query;
   }

}
