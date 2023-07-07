<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

/**
 * Class PurchaseController
 * @package App\Http\Controllers
 */
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type=="client"){
            $purchases = Purchase::where('id_user',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        }else{
            $purchases = Purchase::orderBy('created_at', 'desc')->paginate(5);
        }
        

        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase = new Purchase();
        return view('purchase.create', compact('purchase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Purchase::$rules);
        $first_purchase=is_null(Purchase::select('id')->latest()->first()) ? 'C0001': 'C000'.Purchase::select('id')->latest()->first()->id+1;
        $purchase=Purchase::create([
            'code' => $first_purchase,
            'id_user' => $request['id_user'],
            'id_product' => $request['id_product'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'total' => $request['quantity'] * $request['price']
 
        ]);
// return $purchase;

        return redirect()->route('purchases.index')
            ->with('success', 'Se realizó la compra exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::find($id);

        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);

        return view('purchase.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        request()->validate(Purchase::$rules);

        $purchase->update($request->all());

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id)->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'se eliminó exitosamente');
    }
}
