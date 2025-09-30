<?= $this->extend('admin/layouts/base') ?>

<?= $this->section('title') ?>
Create Product
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Product</h3>
            </div>
            <div class="card-body">
                <!-- Display validation errors if any -->
                <?php if(session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/products/store') ?>" method="post" enctype="multipart/form-data">
                    <!-- CSRF token -->
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                       <select name="kategori" id="" class="form-control">
                        <option value="" disabled selected >Pilih Kategori</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" name="thumbnail[]" id="thumbnail" multiple accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
