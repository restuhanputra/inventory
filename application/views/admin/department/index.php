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
          <!-- Alert -->
          <?php if ($this->session->flashdata("success")) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong><?= $this->session->flashdata("success") ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            usetFlash();
          endif ?>

          <?php if ($this->session->flashdata("error")) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><?= $this->session->flashdata("error") ?></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php
            usetFlash();
          endif ?>
          <!-- /.Alert -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="<?= base_url('department/add') ?>" class="btn btn-primary">Tambah Data</a>
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
                    <th>Departemen</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($departmentData as $department) :
                  ?>
                    <tr>
                      <td style="text-align: center;"><?= $i++; ?></td>
                      <td><?= $department->department_name ?></td>
                      <td style="text-align: center;">
                        <button class="btn btn-success">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
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