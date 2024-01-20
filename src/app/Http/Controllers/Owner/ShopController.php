<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Owner;
use App\Models\Shop;
use InterventionImage;


use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next){
            $id = $request->route()->parameter('shop');
            if(!is_null($id)){
                $shopOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopOwnerId;
                $ownerId = Auth::id();
                if($shopId !== $ownerId){
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
        $shops = Shop::where('owner_id', Auth::id())->get();
        return view('owner.shops.index', compact('shops'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shop = Shop::findOrFail($id);
        return view('owner.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UploadImageRequest $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'information' => ['required', 'string', 'max:2000'],
            'is_selling' => ['required'],
        ]);

        Shop::where('id', $id)->update([
            'name' => $request->name,
            'information' => $request->information,
            'is_selling' => $request->is_selling,
        ]);

        $imageFile = $request->image;

        if(!is_null($imageFile) && $imageFile->isValid()){
            $fileNameToStore = ImageService::upload($imageFile, 'shops');
            Shop::where('id', $id)->update([
                'filename' => $fileNameToStore,
            ]);
        }

        return redirect()
        ->route('owner.shops.index')
        ->with(['message' => '更新が完了しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
