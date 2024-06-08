<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Advertisement;
use App\Models\Purchase;

class CartController extends Controller
{
    public function addToCart(Request $request, $advertisementId)
    {
        $advertisement = Advertisement::findOrFail($advertisementId);
        $user = auth()->user();

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItem = $cart->items()->where('advertisement_id', $advertisementId)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cart->items()->create(['advertisement_id' => $advertisementId, 'quantity' => 1]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function viewCart()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->with('items.advertisement')->first();

        return view('cart.index', compact('cart'));
    }

    public function removeItem(Request $request, $itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }


    public function purchaseHistory()
    {
        // Haal alle aankopen op van de huidige gebruiker
        $user = auth()->user();
        $purchases = Purchase::where('user_id', $user->id)
                             ->with('advertisement')
                             ->orderBy('created_at', 'desc')
                             ->get();

        // Laad de view en geef de aankopen door
        return view('history', compact('purchases'));
    }

    public function purchaseItems(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->with('items.advertisement')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        foreach ($cart->items as $item) {
            Purchase::create([
                'user_id' => $user->id,
                'advertisement_id' => $item->advertisement_id,
                'quantity' => $item->quantity,
            ]);
        }

        // Clear the cart
        $cart->items()->delete();

        return redirect()->route('history')->with('success', 'Purchase completed successfully.');
    }
}
