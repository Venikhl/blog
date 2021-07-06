<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product',[
            'except' => ['index', 'show']
        ]);
    }

    function index(){
        $products = Product::query()
            ->latest()
            ->with('user')
            ->get();
        return view('models.products.index', [
            'products' => $products
        ]);
    }

    function create(){
        return view('models.products.form');
    }

    function store(ProductRequest $request){
        $data = $request->validated();

        $post = auth()->user()
            ->products()
            ->create($data);

        return redirect()->route('products.show', $post);
    }

    function show(Product $product){
        return view('models.products.show', [
            'products' => $product
        ]);
    }

    function edit(Product $product){
        return view('models.products.form', [
            'products' => $product
        ]);
    }

    function update(ProductRequest $request, Product $product){
        $data = $request->validated();

        $product->update($data);

        return redirect()->route('products.show', $product);
    }

    function destroy(Product $product){

        $product->delete();
        return redirect()->route('products.index');
    }
}
