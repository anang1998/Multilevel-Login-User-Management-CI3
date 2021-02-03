<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
        // CEK APAKAH LOGIN? ADA DI HELPER DAN DIPANGGIL DI AUTOLOAD HELPER
        check_is_login();
        // panggil template, buat library template dan panggil di autoload library
		$this->template->load('template', 'dashboard'); 
	}
}
