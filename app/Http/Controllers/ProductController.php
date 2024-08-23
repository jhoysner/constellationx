<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::whereNotIn('id', Payment::select('product_id'))->paginate(10);
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('message', 'Product successfully added.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('message', 'Product successfully updated.');
    }


    public function destroy (Product $product)
    {

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product successfully deleted.');
    }

    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('products.buy', compact('product'));
    }
}
