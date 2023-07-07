<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);

        return view('product.index', compact('products'));
          //  ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }
    
    public function indexPublic()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);

        return view('product.index-public', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Product::$rules);
        $first_product=is_null(Product::select('id')->latest()->first()) ? 'POOO1': 'P000'.Product::select('id')->latest()->first()->id+1;

        $product = Product::create([
            'code' => $first_product,
            'name' => $request['name'],
            'category' => $request['category'],
            'price' => $request['price'],
            'image' => $request['image'],

        ]);

        return redirect()->route('products.index')
            ->with('success', 'Se registró correctamente.');
        // $data=is_null(Product::select('id')->latest()->first()) ? 'null':'no';
        // return 'data: '. $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate(Product::$rules);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Se actualizó correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Se eliminó correctamente');
    }
}
