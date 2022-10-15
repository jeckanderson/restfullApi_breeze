<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ini mereturn json, dan kalau di blade controller return view
        $data = Product::getProduct()->paginate(5);
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_category' => 'required',
            'nama_product' => 'required',
            'harga_product' => 'required',
            'berat_product' => 'required',
            'stok' => 'required',
            'foto' => 'required|file|mimes:jpg,png',
        ]);

        try {
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('foto_produk',$fileName);
            $validasi['foto'] = $path;
            $response = Product::create($validasi);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'error',
                'errors' => $exception->getMessage()
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get reference

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'id_category' => 'required',
            'nama_product' => 'required',
            'harga_product' => 'required',
            'berat_product' => 'required',
            'stok' => 'required',
            'foto' => '',
        ]);

        try {
            if($request->file('foto')) {
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('foto_produk',$fileName);
                $validasi['foto'] = $path;
            }
            
            $response = Product::find($id);
            $response->update($validasi);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'error',
                'errors' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Langkah 1
        // $product = Product::find($id);
        // $product->delete();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Succes',
        // ]);

        //Langkah 2 dengan catch try
        try {
            $product = Product::find($id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Succes',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'error',
                'errors' => $exception->getMessage()
            ]);
        }
    }


    function category()
    {
        $data = Category::all();
        return response()->json($data);
    }


}
