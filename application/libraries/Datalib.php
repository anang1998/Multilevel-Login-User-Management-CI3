<?php

Class datalib{
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
    }
    
//menampilkan data user sesuai id
function user_login(){
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('id_user');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

function count_users(){
    $this->ci->load->model('user_m');
    return $this->ci->user_m->get()->num_rows();
}
}