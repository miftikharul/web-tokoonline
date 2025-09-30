<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProdukModel();
    }

    public function index()
    {
        $data['produk'] = $this->productModel->findAll();
        return view('admin/produk/index', $data);
    }

    public function create()
    {
        return view('admin/produk/create');
    }

    public function store()
    {
        // Load validation library
        $validation = \Config\Services::validation();

        // Set rules for validation
        $validation->setRules([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'foto' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]',
            'thumbnail' => 'uploaded[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|max_size[thumbnail,1024]'
        ]);


        // Perform validation
        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, redirect back to the form page with error messages
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Upload foto and thumbnail
        $foto = $this->request->getFile('foto');
        $thumbnail = $this->request->getFileMultiple('thumbnail');

        $fotoName = $foto->getRandomName();
        $foto->move(ROOTPATH . 'public/uploads/foto_produk/', $fotoName);

        $thumbnailNames = [];
        foreach ($thumbnail as $thumb) {
            if ($thumb->isValid() && !$thumb->hasMoved()) {
                $thumbName = $thumb->getRandomName();
                $thumb->move(ROOTPATH . 'public/uploads/thumbnail/', $thumbName);
                $thumbnailNames[] = $thumbName;
            }
        }

        // Prepare data to be stored
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga' => $this->request->getPost('harga'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $fotoName,
            'thumbnail' => implode(',', $thumbnailNames)
        ];

        // Store data in the database
        $this->productModel->insert($data);

        // Redirect to product index page
        return redirect()->to(route_to('admin.produk'));
    }

    public function edit($id)
    {
        $data['produk'] = $this->productModel->find($id);
        return view('admin/produk/edit', $data);
    }

    public function update($id)
{
    // Load validation library
    $validation = \Config\Services::validation();

    // Set rules for validation
    $validation->setRules([
        'nama_produk' => 'required',
        'harga' => 'required|numeric',
        'kategori' => 'required',
        'deskripsi' => 'required'
    ]);

    // Perform validation
    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Retrieve existing data of the product
    $product = $this->productModel->find($id);

    // Retrieve inputs from the form
    $namaProduk = $this->request->getPost('nama_produk');
    $harga = $this->request->getPost('harga');
    $kategori = $this->request->getPost('kategori');
    $deskripsi = $this->request->getPost('deskripsi');

    // Update foto produk if a new foto is uploaded
    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move(ROOTPATH . 'public/uploads/foto_produk/', $fotoName);

        // Delete old foto produk if it exists
        if ($product['foto'] && file_exists(ROOTPATH . 'public/uploads/foto_produk/' . $product['foto'])) {
            unlink(ROOTPATH . 'public/uploads/foto_produk/' . $product['foto']);
        }
    } else {
        // Keep the existing foto produk
        $fotoName = $product['foto'];
    }

    // Update thumbnails
    $thumbnailFiles = $this->request->getFileMultiple('thumbnail');
    $thumbnailNames = [];

    if ($thumbnailFiles && !empty($thumbnailFiles[0]->getName())) {
        // Delete old thumbnails
        $existingThumbnails = explode(',', $product['thumbnail']);
        foreach ($existingThumbnails as $existingThumbnail) {
            if (!empty($existingThumbnail) && file_exists(ROOTPATH . 'public/uploads/thumbnail/' . $existingThumbnail)) {
                unlink(ROOTPATH . 'public/uploads/thumbnail/' . $existingThumbnail);
            }
        }

        // Upload new thumbnails
        foreach ($thumbnailFiles as $thumbnail) {
            if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
                $thumbnailName = $thumbnail->getRandomName();
                $thumbnail->move(ROOTPATH . 'public/uploads/thumbnail/', $thumbnailName);
                $thumbnailNames[] = $thumbnailName;
            }
        }
    } else {
        // Keep the existing thumbnails
        $thumbnailNames = explode(',', $product['thumbnail']);
    }

    // Update data to be stored
    $data = [
        'nama_produk' => $namaProduk,
        'harga' => $harga,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'foto' => $fotoName,
        'thumbnail' => implode(',', $thumbnailNames)
    ];

    // Update data in the database
    $this->productModel->update($id, $data);

    // Redirect to product index page
    return redirect()->to(route_to('admin.produk'));
}

    

    public function delete($id)
    {
        // Delete product data from the database
        $this->productModel->delete($id);

        // Redirect to product index page
        return redirect()->to(route_to('admin.produk'));
    }
}
