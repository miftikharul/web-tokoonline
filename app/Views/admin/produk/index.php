<?= $this->extend('admin/layouts/base') ?>

<?= $this->section('title') ?>
Products
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Data Produk</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <a href="<?= base_url('admin/products/create') ?>" class="btn btn-warning">Tambah Data Produk</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Foto</th>
                  <th>Thumbnail</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($produk as $key => $item) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $item['nama_produk'] ?></td>
                    <td><?= $item['harga'] ?></td>
                    <td><?= $item['kategori'] ?></td>
                    <td><?= $item['deskripsi'] ?></td>
                    <td><img src="<?= base_url('uploads/foto_produk/' . $item['foto']) ?>" alt="Foto Produk" width="50"></td>
                    <td>
                      <?php
                      $thumbnails = explode(',', $item['thumbnail']);
                      foreach ($thumbnails as $thumbnail) :
                      ?>
                        <img src="<?= base_url('uploads/thumbnail/' . $thumbnail) ?>" alt="Thumbnail" width="20">
                      <?php endforeach; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('admin/products/edit/' . $item['id']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                      <form action="<?= base_url('admin/products/delete/' . $item['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data?')">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<?= $this->endSection() ?>
