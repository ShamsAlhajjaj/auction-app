<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <x-app-layout>
    <div class="container">
        <h1 class="text-center">{{ $product->name }}</h1>
        <p class="lead"><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Seller:</strong> {{ $product->user->name }}</p>
        <div class="text-center mb-4">
            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 300px;">
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $userBid = $product->bids->where('user_id', Auth::id())->first();
        @endphp

        @if ($userBid)
            <div class="alert alert-info">
                <p>You have already submitted an offer for this product:</p>
                <p><strong>Offer Price:</strong> ${{ $userBid->offer_price }}</p>
                <form action="{{ route('bids.destroy', $userBid->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your offer?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Offer</button>
                </form>
            </div>
        @else
            <form action="{{ route('bids.store') }}" method="post" class="text-center" onsubmit="return confirm('Are you sure you want to submit this offer?');">
                @csrf 
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <input type="number" placeholder="Offer Price ($)" name="offer_price" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Offer</button>
            </form>
        @endif

    </div>
    </x-app-layout>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
