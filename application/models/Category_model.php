<?php // Interface between controller and database
class Category_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_categories(){
        $this->db->order_by('name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function create_category(){
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }
        
        $data = array(
            'name' => $this->input->post('name'),
            'user_id' => $this->session->userdata('user_id')
        );

        return $this->db->insert('categories', $data);
    }
    
    public function edit_category(){
        if(!$this->session->userdata('logged_in')){
            redirect('users/login');

            $data = array(
                'id' => $this->input->post('id'), 
                'name'=> $this->input->post('name'),
            );

            $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
        }
    }

    public function get_category($id){
        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->row();
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('categories');
        return true;
        }
}