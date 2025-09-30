<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProdukModel;
use App\Models\CheckoutModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Cart extends Controller
{
    protected $cartModel;
    protected $produkModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->produkModel = new ProdukModel();
        helper('session');
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper(['form', 'url']);
    }

    public function add()
    {
        $session = session();
        $userId = $session->get('id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login to add items to cart.');
        }

        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity', FILTER_VALIDATE_INT);

        if (!$productId || !$quantity || $quantity < 1) {
            return redirect()->back()->with('error', 'Invalid product or quantity.');
        }

        $product = $this->produkModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $existingCartItem = $this->cartModel->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem['quantity'] + $quantity;
            $this->cartModel->update($existingCartItem['id'], ['quantity' => $newQuantity]);
        } else {
            $this->cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product['harga']
            ]);
        }

        return redirect()->to('/cart')->with('success', 'Product added to cart successfully.');
    }

    public function viewCart()
    {
        $userId = session()->get('id');
        $data['cartItems'] = $this->cartModel->getCartItems($userId);
        return view('shopping_cart', $data);
    }

 
    public function checkout($productId)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to proceed checkout.');
        }

         // Load product details
         $produkModel = new ProdukModel();
         $product = $produkModel->find($productId);
 
         if (!$product) {
             return redirect()->back()->with('error', 'Product not found.');
         }
 
         // Load view for checkout form
         return view('checkout_form', ['product' => $product]);
    }

    public function processPayment()
    {
        // Validate user authentication
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to proceed payment.');
        }

        // Load the model
        $checkoutModel = new CheckoutModel();

        // Get data from POST request
        $productId = $this->request->getPost('product_id');
        $shippingAddress = $this->request->getPost('shipping_address');
        $paymentMethod = $this->request->getPost('payment_method');
        $paymentProof = $this->request->getFile('payment_proof');

        // Simpan bukti pembayaran ke server
        $paymentProofName = $paymentProof->getRandomName();
        $paymentProof->move(ROOTPATH . 'public/uploads/payment_proof', $paymentProofName);

        // Simpan informasi checkout ke dalam database
        $checkoutData = [
            'user_id' => session()->get('id'),
            'product_id' => $productId,
            'shipping_address' => $shippingAddress,
            'payment_method' => $paymentMethod,
            'payment_proof' => $paymentProofName,
            'payment_status' => 'Pending'
        ];

        $checkoutModel->insert($checkoutData);

        // Redirect atau tampilkan pesan berhasil checkout
        return redirect()->to('/success')->with('success', 'Checkout successful.');
    }

    public function success()
    {
        return view('success');
    }
}
