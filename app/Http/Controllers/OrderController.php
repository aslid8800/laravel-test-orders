<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $orders = \App\Models\Order::with('product')->get();
    return view('orders.index', compact('orders'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $products = \App\Models\Product::all();
    return view('orders.create', compact('products'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'order_date' => 'required|date',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'comment' => 'nullable|string',
    ]);

    \App\Models\Order::create([
        'customer_name' => $request->customer_name,
        'order_date' => $request->order_date,
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'comment' => $request->comment,
        'status' => 'новый',
    ]);

    return redirect()->route('orders.index')->with('success', 'Заказ создан.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $order = \App\Models\Order::with('product')->findOrFail($id);
    return view('orders.show', compact('order'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $order = \App\Models\Order::findOrFail($id);

    if ($request->input('status') === 'выполнен') {
        $order->status = 'выполнен';
        $order->save();
        return redirect()->route('orders.show', $order->id)->with('success', 'Статус заказа обновлён.');
    }

    return redirect()->route('orders.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
