<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::findOrFail($request->product_id);

        // info('Stripe Token: ' . $request->stripeToken);

        try {
            $charge = Charge::create([
                'amount' => $product->price * 100,
                'currency' => 'usd',
                'description' => 'Compra de ' . $product->name,
                'source' => $request->stripeToken,
            ]);

            Payment::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'stripe_charge_id' => $charge->id,
                'amount' => $product->price,
                'currency' => 'usd',
            ]);

            return redirect()->route('products.index')->with('message', 'Purchase made successfully.');
        } catch (\Exception $e) {
            info($e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
