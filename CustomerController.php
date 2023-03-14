<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produk::all();
        return['produk' => $produk,
    ]; 
    }


    // public function total()
    // {
    //     $data = produk::count();
    //     return response()->json([
    //         'Total User' => $data]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img_name = Str::random(10) . '.jpg';
        $request->file('gambar')->storeAs('public/storage/gambar',$img_name);
        $produk = produk::create([
            'judulproduk' => $request->judulproduk,
            'deskripsiproduk' => $request->deskripsiproduk,
            'harga' => $request->harga,
            'gambar' => $img_name,
        ]);
        return response()->json([
            'produk' => $produk
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(produk $produk, $id)
    {
        $produk = produk::find($id);
        $produk = produk::all();
         return response()->json([
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produk $produk,$id)
    {
        $data = produk::find($id);
        $data->update($request->all());
        // $data->judulproduk = $request->judulproduk;
        // $data->deskripsiproduk = $request->deskripsiproduk;
        // $data->harga = $request->harga;
        // $data->save();
        return response()->json([
            'produk' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk,$id)
    {
        Log::info('data dihapus');
        $produk = produk::find($id);
        $produk->delete();
        return response()->json([
            'message' => 'data dihapus'
        ]);
    }
}
