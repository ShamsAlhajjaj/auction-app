<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::query();

        // Check if there is a search
        if (request()->has('productName')) {
            $query->where('name', 'like', '%' . request()->get('productName', '') . '%');
        }
        // Check if there is a search by seller name
        if (request()->has('sellerName')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request()->get('sellerName', '') . '%');
            });
        }

        // Execute the query to get the results
        $products = $query->get();

        return view('products/index', ['products' => $products]);
    }


    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Validate the form data
         $request->validate([
             'name' => ['required', 'string', 'max:200'],
             'description' => ['required', 'string', 'min:50'],
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
     
         if ($request->hasFile('image')) {
             // Get the file from the request
             $file = $request->file('image');
     
             // Define the path
             $destinationPath = 'images/';
     
             // Generate a unique name for the image using the current timestamp
             $imageName = time() . '_' . $file->getClientOriginalName();
     
             // Move the image to the desired folder
             $file->move(public_path($destinationPath), $imageName);
     
             // Create a new product record in the database
             $product = new Product();
             $product->name = $request->input('name');
             $product->description = $request->input('description');
             $product->user_id = Auth::id(); // Current Authenticated user_id
             $product->image = $imageName;
             $product->save();
     
             // Redirect back with a success message
             return redirect()->back()->with('success', 'Product added successfully!');
         }
     
         // If the file upload fails, redirect back with an error message
         return redirect()->back()->with('error', 'Image upload failed. Please try again.');
     }
     
     

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        // Query the product by its ID and include the seller's (user's) information
        $product = Product::with('user')->find($productId);
    
        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        // Return the product view with the product details
        return view('products.details', ['product' => $product]);
    }
    
    public function myProducts()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Fetch the products owned by the user along with their bids
    $products = Product::with(['bids.user'])->where('user_id', $user->id)->get();

    return view('products.myProducts', compact('products'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy($id)
    {
        // Find the product by ID and ensure the authenticated user is the owner
        $product = Product::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$product) {
            return redirect()->back()->with('error', 'You are not authorized to delete this product or it does not exist.');
        }

        // Delete the product image from storage
        if (file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    
}
