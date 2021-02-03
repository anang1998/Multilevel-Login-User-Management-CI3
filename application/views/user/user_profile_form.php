<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

 <!-- Main content -->
 <section class="content">
 <?php $this->view('message')?> 


<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Info</h3>
        <div class="pull-right">
            <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">
                <i class="fa fa-undo"></i> Back
            </a>
        </div>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-4">

                <form action="" method="post">
                    <div class="form-group <?=form_error('name_nm')? 'has-error': null?>"> <!-- kondisi jika ingin eror merah -->
                        <label>Name*</label>
                        <input type="hidden" name="iduser_nm" value="<?=$row->id_user?>">
                        <input type="text" name="name_nm" value="<?=$this->input->post('name_nm') ?? $row->name ?>" class="form-control">
                        <?=form_error('name_nm')?>
                    </div>
                    <div class="form-group <?=form_error('username_nm')? 'has-error': null?>">
                        <label>Username*</label>
                        <input type="text" name="username_nm" value="<?=$this->input->post('username_nm') ?? $row->username ?>" class="form-control" readonly>
                        <?=form_error('username_nm')?>
                    </div>
                    <div class="form-group <?=form_error('password_nm')? 'has-error': null?>">
                        <label>Password*</label> <small>Biarkan kosong jika tidak diganti</small>
                        <input type="password" name="password_nm" value="<?=set_value('password_nm')?>" class="form-control">
                        <?=form_error('password_nm')?>
                    </div>
                    <div class="form-group <?=form_error('passwordconf_nm')? 'has-error': null?>">
                        <label>Password Confirmation*</label>
                        <input type="password" name="passwordconf_nm" value="<?=set_value('passconf')?>" class="form-control">
                        <?=form_error('passwordconf_nm')?>
                    </div>
                    <div class="form-group">
                        <label>ID Number*</label>
                        <input type="text" name="idnumber_nm" value="<?=$this->input->post('idnumber_nm') ?? $row->id_number ?>" class="form-control" readonly>
                        <!-- <textarea name="alamat" class="form-control"><?=set_value('alamat')?></textarea> -->
                        <?=form_error('idnumber_nm')?>
                    </div>
                    <div  class="form-group <?=form_error('level_nm')? 'has-error': null?>">
                    <!-- DI HIDE PAKE JS DI BAWAH, SET PAKE ID DAN STYLE, KARENA PAKE READONLY MASIH DROPDOWN -->
                        <label id='sel1' style='display:none;'>Level*</label>
                        <select name="level_nm" class="form-control" id='sel1' style='display:none;'>
                        <?php $level = $this->input->post('level_nm') ? $this->input->post('level_nm') : $row->level ?> 
                            <option value="1" <?=$level == 1 ? 'selected' : null?> >Admin</option>
                            <option value="2" <?=$level == 2 ? 'selected' : null?> >SubAdmin</option>
                        </select>
                        <?=form_error('level_nm')?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-flat">
                            <i class="fa fa-paper-plane"></i> Simpan
                        <!-- </button>
                        <button type="reset" class="btn btn-flat">Reset</button> -->
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>

</section>

<script type="text/javascript">

        function hide(){
          var elem = document.getElementById('sel1');
          elem.style.display = 'none';
        }

        function show(){
          var elem = document.getElementById('sel1');
          elem.style.display = 'inline';
        }
