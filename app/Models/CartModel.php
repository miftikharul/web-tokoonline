<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'price'];

    public function getCartItems($userId)
    {
        return $this->select('cart.*, produk.nama_produk, produk.foto')
                    ->join('produk', 'produk.id = cart.product_id')
                    ->where('cart.user_id', $userId)
                    ->findAll();
    }
}
