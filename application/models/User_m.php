<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    public function login($post)
    {
        // $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $post['username_nm']);
        $this->db->or_where('id_number', $post['username_nm']);
        $this->db->where('password', sha1($post['password_nm']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null){
        $this->db->from('users');
        if($id != null){
            $this->db->where('id_user', $id);
        }
        $this->db->order_by('id_user', 'desc');
        $query = $this->db->get();
        return $query;
    }

   
    public function add($post){
        $data['name'] = $post['name_nm'];
        $data['username'] = $post['username_nm'];
        $data['password'] = sha1($post['password_nm']);
        $data['id_number'] = $post['idnumber_nm'] != "" ? $post['idnumber_nm'] : null;
        $data['level'] = $post['level_nm'];
        $this->db->insert('users', $data);
    }

    public function edit($post){
        /// database = name di view
        $data['name'] = $post['name_nm'];
        $data['username'] = $post['username_nm'];
        // jika tidak kosong post password
        if(!empty($post['password_nm'])){
            $data['password'] = sha1($post['password_nm']);
        }
        // $data['id_number'] = $post['idnumber_nm'] != "" ? $post['idnumber_nm'] : null;
        $data['id_number'] = $post['idnumber_nm'];
        $data['level'] = $post['level_nm'];
        

        $this->db->where('id_user', $post['iduser_nm']);
        $this->db->update('users', $data);
    }

    public function delete($id){
        $this->db->where('id_user', $id);
        $this->db->delete('users');
    }
}