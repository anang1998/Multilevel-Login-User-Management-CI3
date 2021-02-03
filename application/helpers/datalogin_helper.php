<?php

function check_is_already_login() {
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id_user');
    if($user_session){
        redirect('dashboard');
    }
}

function check_is_login() {
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id_user');
    if(!$user_session){
        redirect('auth/login');
    }
}

function check_is_admin(){
    $ci =& get_instance();
    $ci->load->library('datalib');
    if($ci->datalib->user_login()->level != 1){
        redirect('dashboard');
    }
}

