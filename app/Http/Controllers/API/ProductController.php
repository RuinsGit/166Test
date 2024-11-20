<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')
            ->latest()
            ->paginate(10);
            
        return new ProductCollection($products);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = auth()->user()->products()->create($request->validated());
        
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        
        return response()->json(null, 204);
    }
}
