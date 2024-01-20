<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Shop;
use Carbon\Carbon;
use Throwable;


class OwnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')
        ->orderBy('id', 'desc')
        ->paginate(5);

        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Owner::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try{
            DB::transaction(function() use($request){
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => 'shop' . $owner->id,
                    'information' => 'information' . $owner->id,
                    'filename' => '',
                    'is_selling' => true
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e; 
        }

        

        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => '登録が完了しました。', 'status' => 'info']);
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
    public function edit(string $id)
    {
        $owner = Owner::findOrFail($id);

        return view('admin.owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Owner::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Owner::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        
        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => '更新が完了しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Owner::findOrFail($id)->delete();
        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => '削除しました。', 'status' => 'alert']);
    }

    public function expiredOwnerindex()
    {
        $expiredOwners = Owner::onlyTrashed()->get();
        return view('admin.expired-owners', compact('expiredOwners'));
    }

    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
       
        return redirect()
        ->route('admin.expired-owners.index')
        ->with(['message' => '期限切れオーナーを削除しました。', 'status' => 'alert']);
    }
}
