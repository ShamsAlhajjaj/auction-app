<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $products)
    {
        $products = Product::get();
        return Inertia::render('Frontend/Product/Index', ['products' => $products]);

    }
    public function filterByProductName(Request $request)
    {
        // Get the product name from the request query parameter
        $productName = $request->query('productName');
    
        // Build the query to filter products by name
        $query = Product::query();
    
        // Apply the filter if a product name is provided
        if (!empty($productName)) {
            $query->where('name', 'LIKE', '%' . $productName . '%');
        }
    
        // Retrieve the filtered products
        $filteredProducts = $query->get();
    
        // Return the filtered products to the Inertia view
        return Inertia::render('Frontend/Product/Index', ['products' => $filteredProducts]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Frontend/Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'required|string|min:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => $request->user_id,
        ]);



        return redirect()->to("/products")->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = Product::get();
        return Inertia::render('Frontend/Product/Edit', [
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
