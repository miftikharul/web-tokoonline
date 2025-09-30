<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'user_id',
        'product_id',
        'shipping_address',
        'payment_method',
        'payment_proof',
        'payment_status',
        'created_at'
    ];

    protected $useTimestamps = false; // Set to true if you want to use automatic timestamps
}
