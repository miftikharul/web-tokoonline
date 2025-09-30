<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .success-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-card {
            border-color: #28a745;
        }
        .success-card .card-body {
            color: #28a745;
        }
        .success-icon {
            font-size: 3rem;
            color: #28a745;
        }
    </style>
</head>
<body>
<div class="container success-container">
    <div class="card success-card">
        <div class="card-body text-center">
            <i class="fas fa-check-circle success-icon"></i>
            <h2 class="card-title mt-3">Checkout Successful!</h2>
            <p class="card-text">Thank you! Your order is being processed.</p>
            <a href="<?= base_url('home') ?>" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
