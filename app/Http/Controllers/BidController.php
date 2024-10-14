<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::all();
        return view('posts.index', ['bids' => $bids]);
    }

    // Create a new bid
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'offer_price' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id',
        ]);
    
        // Check if the user has already submitted an offer for this product
        $existingBid = Bid::where('product_id', $request->input('product_id'))
                          ->where('user_id', Auth::id())
                          ->first();
    
        if ($existingBid) {
            return redirect()->back()->with('error', 'You have already submitted an offer for this product.');
        }
    
        // Create a new bid with the data from the form
        $bid = new Bid();
        $bid->offer_price = $request->input('offer_price');
        $bid->product_id = $request->input('product_id');
        $bid->user_id = Auth::id(); // Use the currently authenticated user's ID
        $bid->save();
    
        return redirect()->back()->with('success', 'Price offer submitted successfully.');
    }
    
    
    

    // Update a specific bid
    public function update(Request $request, $id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        $validatedData = $request->validate([
            'offer_price' => 'sometimes|numeric|min:0',
        ]);

        $bid->update($validatedData);

        return view('bids');
    }

    // Delete a specific bid
    public function destroy($id)
    {
        $bid = Bid::where('id', $id)->where('user_id', Auth::id())->first();
    
        if (!$bid) {
            return redirect()->back()->with('error', 'You are not authorized to delete this offer.');
        }
    
        $bid->delete();
        return redirect()->back()->with('success', 'Your offer has been deleted successfully.');
    }
    
}
