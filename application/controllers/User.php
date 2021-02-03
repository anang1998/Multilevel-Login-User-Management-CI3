<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    //load model langsung
    function __construct(){
        parent::__construct();
        check_is_login(); // helper
        $this->load->model('user_m');
        $this->load->library('form_validation');
    }

	public function index()
	{
        check_is_admin(); //helper
        // $this->load->model('user_m');
        $data['row'] = $this->user_m->get();

        $this->template->load('template', 'user/user_data', $data);
    }
    
    public function add_user()
    {
        check_is_admin();
        //$this->load->library('form_validation');

        $this->form_validation->set_rules('name_nm', 'Name', 'required');
        $this->form_validation->set_rules('username_nm', 'Username', 'required|min_length[5]|is_unique[users.username]'); //isuniq tabel.field
        $this->form_validation->set_rules('password_nm', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passwordconf_nm', 'Password Comfirmation', 'required|matches[password_nm]',
            array('matches' => '%s tidak sesuai password')
        );
        $this->form_validation->set_rules('idnumber_nm', 'ID Number', 'required');
        $this->form_validation->set_rules('level_nm', 'Level', 'required');

        /// set message untuk required
        $this->form_validation->set_message('required', '%s perlu diisi');
        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s sudah ada');

        // $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>'); // memerahkan set message


        if($this->form_validation->run() == FALSE){
            $this->template->load('template', 'user/user_add_form');
        }else{
            $post = $this->input->post(null, TRUE);

            $this->user_m->add($post);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success','Data berhasil disimpan');
            }
            redirect('user');
        }
    }

    public function edit_user($id)
    {
        check_is_admin();
        $this->form_validation->set_rules('name_nm', 'Name', 'required');
        $this->form_validation->set_rules('username_nm', 'Username', 'required|min_length[5]|callback_username_check'); //isuniq tabel.field
        if($this->input->post('password_nm')){
            $this->form_validation->set_rules('password_nm', 'Password', 'min_length[5]');
            $this->form_validation->set_rules('passwordconf_nm', 'Konfirmasi password', 'matches[password_nm]',
            array('matches' => '%s tidak sesuai password')
            );
        }
        if($this->input->post('passwordconf_nm')){
            $this->form_validation->set_rules('password_nm', 'Password', 'min_length[5]',
            array('matches' => '%s tidak sesuai password')
            );
        }
        
        $this->form_validation->set_rules('level_nm', 'Level', 'required');
        /// set message untuk required
        $this->form_validation->set_message('required', '%s perlu diisi');
        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s sudah ada');

        // $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>'); /// memerahkan set message


        if($this->form_validation->run() == FALSE){
            $decrypt_id = decrypt($id);
            $query = $this->user_m->get($decrypt_id); // penjelasan enkrip ada di helper
            if($query->num_rows() > 0){
                $data['row'] = $query->row(); //karna ambil 1 di row
                $this->template->load('template', 'user/user_edit_form', $data);
            }else {
                echo "<script>
                    alert('Data tidak ada');";
                echo "window.location='".site_url('user')."';
                </script>";
            }
            
        }else{
            $post = $this->input->post(null, TRUE);

            $this->user_m->edit($post);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success','Data berhasil disimpan');
            }
            redirect('user');
        }
    }

    public function profile_user($id)
    {
        if(decrypt($id) == $this->datalib->user_login()->id_user)
        {
            $this->form_validation->set_rules('name_nm', 'Name', 'required');
            $this->form_validation->set_rules('username_nm', 'Username', 'required|min_length[5]|callback_username_check'); //isuniq tabel.field
            if($this->input->post('password_nm')){
                $this->form_validation->set_rules('password_nm', 'Password', 'min_length[5]');
                $this->form_validation->set_rules('passwordconf_nm', 'Konfirmasi password', 'matches[password_nm]',
                array('matches' => '%s tidak sesuai password')
                );
            }
            if($this->input->post('passwordconf_nm')){
                $this->form_validation->set_rules('password_nm', 'Password', 'min_length[5]',
                array('matches' => '%s tidak sesuai password')
                );
            }
            
            $this->form_validation->set_rules('level_nm', 'Level', 'required');
            /// set message untuk required
            $this->form_validation->set_message('required', '%s perlu diisi');
            $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
            $this->form_validation->set_message('is_unique', '%s sudah ada');

            // $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>'); /// memerahkan set message


            if($this->form_validation->run() == FALSE){
                
                $query = $this->user_m->get(decrypt($id)); // penjelasan enkrip ada di helper
                if($query->num_rows() > 0){
                    $data['row'] = $query->row(); //karna ambil 1 di row
                    $this->template->load('template', 'user/user_profile_form', $data);
                }else {
                    echo "<script>
                        alert('Data tidak ada');";
                    echo "window.location='".site_url('user')."';
                    </script>";
                }
                
            }else{
                $post = $this->input->post(null, TRUE);

                $this->user_m->edit($post);
                if($this->db->affected_rows() > 0){
                    $this->session->set_flashdata('success','Data berhasil disimpan');
                }
                redirect('user/profile_user/'.encrypt($this->datalib->user_login()->id_user));
            }
        }else{
            redirect('dashboard');
        }
        
    }

    //untuk callback
    function username_check(){
        //menampung inputan
        $post = $this->input->post(null, TRUE);
        // data user usernamenya sesuai dg inputan tapi id nya tidak sedang di edit
        $query = $this->db->query("SELECT * FROM users WHERE username = '$post[username_nm]' AND id_user != '$post[iduser_nm]'");
        if($query->num_rows()>0){
            $this->form_validation->set_message('username_check', '%s ini sudah dipakai');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function delete_user()
        {
            check_is_admin();
            $id = $this->input->post('id_user');
            $this->user_m->delete($id);

            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Data berhasil dihapus');
                </script>";
            }
            echo "<script>
                    window.location='".site_url('user')."';
                </script>";
        }

}