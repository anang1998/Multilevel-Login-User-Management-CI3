<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
      </ol>
    </section>

 <!-- Main content -->
    <section class="content">
<!-- FLASH DATA -->
    <?php $this->view('message')?> 

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Users</h3>
                <div class="pull-right">
                    <a href="<?=site_url('user/add_user')?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"></i> Add User
                    </a>
                </div>
            </div>

            <div class="box-body table-responsive">
                
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;
                        foreach($row->result() as $data) { ?>
                        <tr>
                             <td style="width:5%"><?=$no++?></td>
                             <td><?=$data->username?></td>
                             <td><?=$data->name?></td>
                             <td><?=$data->id_number?></td>
                             <td><?=$data->level == 1 ? "Admin" : "SubAdmin"?></td>
                             <td class="text-center" width="160px">
                             <form action="<?=site_url('user/delete_user')?>" method="post">
                                <a href="<?=site_url('user/edit_user/'.encrypt($data->id_user))?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-pencil"></i> 
                                </a>
                                
                                <input type="hidden" name="id_user" value="<?=$data->id_user?>">
                                <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> 
                                </button>
                                </form>
                             </td>

                        </tr> 
                        <?php 
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>