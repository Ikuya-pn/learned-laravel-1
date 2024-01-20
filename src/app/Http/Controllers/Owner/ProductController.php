<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SecondaryCategory;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\Owner;
use App\Models\Image;
use App\Models\Stock;
use App\Models\Shop;
use Throwable;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request, $next){
            $id = $request->route()->parameter('product');
            if(!is_null($id)){
                $productOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productId = (int)$productOwnerId;
                $ownerId = Auth::id();
                if($productId !== $ownerId){
                    abort(404);
                }
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerInfo = Owner::with('shop.product.firstImage')->where('id', Auth::id())->get();

        foreach($ownerInfo as $owner){
            $owner = $owner;
        }

        return view('owner.products.index', compact('owner'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::where('owner_id', Auth::id())->get();

        $images = Image::where('owner_id', Auth::id())->get();

        $categories = PrimaryCategory::with('secondary')->get();

        return view('owner.products.create', compact('categories', 'shops', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try{
            DB::transaction(function() use($request){
                $product = Product::create([
                    'shop_id' => $request->shop,
                    'secondary_category_id' => $request->category,
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'is_selling' => $request->is_selling,
                    'sort_order' => $request->sort_order,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('owner.products.index')
        ->with(['message' => '商品登録が完了しました。', 'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $shops = Shop::where('owner_id', Auth::id())->get();
        $images = Image::where('owner_id', Auth::id())->get();
        $categories = PrimaryCategory::with('secondary')->get();
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        return view('owner.products.edit', compact('product', 'shops', 'images', 'categories', 'quantity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $request->validate([
            'current_quantity' => 'required|integer|',
        ]);

        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if($request->current_quantity !== $quantity){
            return redirect()
                ->route('owner.products.edit', ['product' => $product->id])
                ->with(['message' => '在庫数が変動しました。もう一度更新してください。', 'status' => 'alert']);
        }

        try{
            DB::transaction(function() use($request, $product){
                $product->update([
                    'shop_id' => $request->shop,
                    'secondary_category_id' => $request->category,
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'is_selling' => $request->is_selling,
                    'sort_order' => $request->sort_order,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                ]);

                if($request->type === '1'){
                    $newQuantity = $request->quantity;
                }
                if($request->type === '2'){
                    $newQuantity = $request->quantity * -1;
                }

                Stock::create([
                    'product_id' => $product->id,
                    'type' => $request->type,
                    'quantity' => $newQuantity,
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('owner.products.index')
            ->with(['message' => '商品情報の更新が完了しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('owner.products.index')
            ->with(['message' => '商品の削除が完了しました。', 'status' => 'info']);
    }
}
