<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            max-height: 200px; /* Set a maximum height for the image */
            object-fit: cover; /* Maintain aspect ratio and cover the space */
        }
    </style>
</head>
<body>
    <x-app-layout>
    <div class="container">
        <form action="{{ route('index') }}" method="get" class="mb-4">
            <input type="text" name="productName" class="form-control mb-2" placeholder="Search By Product Name">
            <button class="btn btn-primary">Search</button>
        </form>

        <form action="{{ route('index') }}" method="get" class="mb-4">
            <input type="text" name="sellerName" class="form-control mb-2" placeholder="Search By Seller Name">
            <button class="btn btn-primary">Search</button>
        </form>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4"> <!-- Change col-md-4 to col-md-3 for 4 cards per row -->
                    <div class="card">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Seller:</strong> {{ $product->user->name }}</p>
                            <a href="{{ route('products.details', ['productId' => $product->id]) }}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
