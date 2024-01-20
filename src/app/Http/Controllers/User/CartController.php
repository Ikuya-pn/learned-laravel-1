<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendThanksMail;
use App\Jobs\SendOrderedMail;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;

class CartController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:users');
    }

    public function add(Request $request)
    {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()
            ->route('user.items.index')
            ->with(['message' => '商品をカートに追加しました。', 'status' => 'info']);
    }

    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;


        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity; 
        }

        return view('user.cart.index', compact('products', 'totalPrice'));
    }

    public function destroy(string $id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()
            ->route('user.cart.index')
            ->with(['message' => 'カートから商品を削除しました。', 'status' => 'info']);
    }

    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $lineItems = [];
        foreach($products as $product)
        {
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');

            if($quantity < $product->pivot->quantity){
                return redirect()->route('user.cart.index')->with(['message' => '在庫が足りません。', 'status' => 'alert']);
            }else{
                $price_data = ([
                    'unit_amount' => $product->price,
                    'currency' => 'jpy',
                    'product_data' => $product_data = ([
                        'name' => $product->name,
                        'description' => $product->information,
                    ]),
                ]);
                $lineItem = [
                    'price_data' => $price_data,
                    'quantity' => $product->pivot->quantity,
                ];
                array_push($lineItems, $lineItem);
            }    
        }

        foreach($products as $product)
        {
            Stock::create([
                'product_id' => $product->id,
                'type' => 2,
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[$lineItems]],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel'),
        ]);

        $publicKey = config('services.stripe.public');

        return view('user.checkout', compact('session', 'publicKey'));
    }

    public function success()
    {
        $itemsInCart = Cart::where('user_id', Auth::id())->get();
        $products = CartService::getItemsInCart($itemsInCart);
        $user = User::findOrFail(Auth::id());
        SendThanksMail::dispatch($products, $user);

        foreach($products as $product){
            SendOrderedMail::dispatch($product, $user);
        }
        
        Cart::where('user_id', Auth::id())->delete();
        
        return redirect()
         ->route('user.items.index')
         ->with(['message' => '支払いが完了しました。', 'status' => 'info']);
    }

    public function cancel()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        foreach($products as $product){
            Stock::create([
                'product_id' => $product->id,
                'type' => 1,
                'quantity' => $product->pivot->quantity,
            ]);
        }

        return redirect()
            ->route('user.cart.index')
            ->with(['message' => 'お支払いをキャンセルしました。', 'status' => 'info']);
        
    }
}
