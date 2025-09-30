<?= $this->extend('admin/layouts/base') ?>

<?= $this->section('title') ?>
    Edit Product
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/products/update/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <?= csrf_field() ?>
    <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= old('nama_produk', $produk['nama_produk']) ?>" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" value="<?= old('harga', $produk['harga']) ?>" required>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="<?= old('kategori', $produk['kategori']) ?>" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= old('deskripsi', $produk['deskripsi']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="foto">Foto Produk</label>
        <input type="file" name="foto" id="foto" accept="image/*" class="form-control mb-3">
        <img src="<?= base_url('uploads/foto_produk/' . $produk['foto']) ?>" alt="Foto Produk" width="100">
    </div>
    <div class="form-group">
        <label for="thumbnail">Thumbnail</label>
        <input type="file" name="thumbnail[]" id="thumbnail" multiple accept="image/*" class="form-control mb-3">
        <?php
        $thumbnails = explode(',', $produk['thumbnail']);
        foreach ($thumbnails as $thumbnail) {
            echo '<img src="' . base_url('uploads/thumbnail/' . $thumbnail) . '" alt="Thumbnail" width="100">';
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
