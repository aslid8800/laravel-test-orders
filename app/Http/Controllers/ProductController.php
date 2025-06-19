<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0.01',
        'description' => 'nullable|string',
    ]);

    $request->merge([
        'price' => intval($request->price * 100),
    ]);

    Product::create($request->all());

    return redirect()->route('products.index')->with('success', 'Товар добавлен.');
}


    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0.01',
        'description' => 'nullable|string',
    ]);

    $request->merge([
        'price' => intval($request->price * 100),
    ]);

    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Товар обновлён.');
}


    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Товар удалён.');
    }
}
