<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\sendThanksMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\Stock;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function($request, $next) {
            $id = $request->route()->parameter('item');
            if(!is_null($id)){
                $itemId = Product::availableItems()->where('product_id', $id)->exists();
                if(!$itemId){
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $products = Product::availableItems()
            ->sortOrder($request->sort)
            ->selectCategory($request->category ?? '0')
            ->searchKeyword($request->keyword)->paginate(12);

        $categories = PrimaryCategory::with('secondary')->get();
   
        return view('user.index', compact('products', 'categories'));
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        if($quantity >= 9){
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}
