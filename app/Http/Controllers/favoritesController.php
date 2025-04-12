<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class favoritesController extends Controller
{
    public function toggleFavorite($productId)
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);

        if ($user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->detach($productId);
            return back()->with('message', 'Removed from favorites');
        } else {
            $user->favorites()->attach($productId);
            return back()->with('message', 'Added to favorites');
        }
    }


    public function favorites()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('category', 'brand')->get();


        return view('frontend.favorites', compact('favorites'));
    }
    public function destroy($productId)
    {
        $user = auth()->user();

        // Detach the product from the user's favorites
        $user->favorites()->detach($productId);

        return back()->with('message', 'Removed from favorites.');
    }
}
