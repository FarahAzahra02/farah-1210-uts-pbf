<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //panggil validator untuk validasi inputan
use App\Models\Product; //panggil model product.php

class ProductController extends Controller
{
    //memvalidasi data ke database
    public function store(Request $request) {
        //memvalidasi inoutan
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:50', // Perbaikan panah di aturan validasi
            'product_type' => 'required|in:snack,drink,fruit,drug,groceries,cigarette,make-up,cigarette', // Perbaikan panah di aturan validasi
            'product_price' => 'required|numeric',
            'expired_at' => 'required|date',
        ]);

        //kondisi apabila inputan yang diinginkan tidak sesuai
        if ($validator->fails()) { // Perbaikan pada pengecekan fail()
            return response()->json($validator->messages(), 422); // Perbaikan pada response json
        }

        $payload = $validator->validated();
        //Masukkan inputan yang benar ke database (tabel product)
        $payload = $validator->validated();
        Product::create([
            'product_name' => $payload['product_name'], // Perbaikan panah di array
            'product_type' => $payload['product_type'], // Perbaikan panah di array
            'product_price' => $payload['product_price'], // Perbaikan panah di array
            'expired_at' => $payload['expired_at'], // Perbaikan panah di array
        ]);

        //response json akan dikirm jika inputan benar
        return response()->json([
            'msg' => 'Data produk berhasil disimpan' // Perbaikan panah di array
        ], 201);
    } 
    
    function showAll(){

        //panggil semua data produk dari tabel products
        $products = Product::all();

        //kirim respon json

        return response()->json([
            'msg' => 'Data produk keseluruhan',
            'data' => $products
        ],200);
    
    }

    function showById(){
    
    }

    function showByName(){
    
    }

}
