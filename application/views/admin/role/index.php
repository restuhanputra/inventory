<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $title ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <!-- col-12 -->
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="<?= base_url('role/add') ?>" class="btn btn-primary">Tambah Data</a>
              </h3>
            </div>
            <!-- /.card-header -->
            <style>
              table th {
                text-align: center;
              }
            </style>
            <div class="card-body">
              <table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($roleData as $role) :
                  ?>
                    <tr>
                      <td style="text-align: center;"><?= $i++; ?></td>
                      <td><?= $role->role_name ?></td>
                      <td style="text-align: center;">
                        <a href="<?= base_url('role/edit/' . $role->id); ?>" class="btn btn-success">Edit</a>
                        <button class="btn btn-danger delete-role" data-id="<?= $role->id; ?>">Hapus</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <!-- <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Departemen</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot> -->
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-12 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if ($this->session->flashdata("success")) : ?>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata("success"); ?>" data-type="success"></div>
<?php
  usetFlash();
endif; ?>
<?php if ($this->session->flashdata("error")) : ?>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata("error"); ?>" data-type="error"></div>
<?php
  usetFlash();
endif; ?>