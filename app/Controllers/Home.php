<?php

namespace App\Controllers;
use App\Models\ProdukModel;

class Home extends BaseController
{
   
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProdukModel();
    }

    public function landing()
    {
        $data['produk'] = $this->productModel->findAll();
        return view('landing', $data);
    }

    public function index(): string
    {
        $data['produk'] = $this->productModel->findAll();
        return view('home', $data);
    }

    public function getProductData($id)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            return $this->response->setJSON($product);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Product not found']);
        }
    }
}
