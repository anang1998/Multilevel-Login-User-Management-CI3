<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_is_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		/// PERLU PANGGIL LIBRARY DATABASE DAN SESSION DI AUTOLOAD LIBRARY
		$post=$this->input->post(null, TRUE);
		if(isset($post['log_in'])){
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if($query->num_rows() > 0){
				$row = $query->row();
				$params = array(
					'id_user' => $row->id_user,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				redirect('dashboard');
			}else{
				// echo "<script>
				// 	alert('Login Gagal');
				// 	window.location='".site_url('auth/login')."';
				// </script>";
				$this->session->set_flashdata('error','Username atau password salah');
			}
			redirect('auth/login');
		}
	}

	public function logout()
	{
		$params = array('id_user', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
