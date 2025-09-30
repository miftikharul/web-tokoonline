<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <!-- Detail Produk -->
    <div class="card mb-4">
      <div class="card-body" style="border:1px solid yellow;">
        <h5 class="card-title"><?= $product['nama_produk'] ?></h5>
        <p class="card-text text-danger">Price: Rp <?= $product['harga'] ?></p>
        <p class="card-text">Description: <?= $product['deskripsi'] ?></p>
      </div>
    </div>

    <!-- Form Checkout -->
   <div class="card" style="border:1px solid yellow;">
   <form action="<?= route_to('checkout.process') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
   <?= csrf_field() ?>
      <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

      <div class="card-body">
        <div class="form-group">
          <label for="shipping_address">Shipping Address</label>
          <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
          <div class="invalid-feedback">
            Please provide a shipping address.
          </div>
        </div>

        <div class="form-group">
          <label for="payment_method">Payment Method</label>
          <select class="form-control" id="payment_method" name="payment_method" required>
            <option value="" disabled selected>Select payment method</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="PayPal">PayPal</option>
          </select>
          <div class="invalid-feedback">
            Please select a payment method.
          </div>
        </div>

        <div class="form-group">
          <label for="payment_proof">Payment Proof</label>
          <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
          <div class="invalid-feedback">
            Please upload payment proof.
          </div>
        </div>

        <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit Payment</button>
        <a href="<?= base_url('home')?>" class="btn btn-secondary">Kembali Ke Home</a>
        </div>
      </div>
    </form>
   </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>