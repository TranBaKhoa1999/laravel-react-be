<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);

        // Lấy sản phẩm với phân trang
        $products = Product::paginate($limit);

        // return ProductResource::collection($products);
        // return new ProductCollection($products);
        // return printJson(ProductResource::collection($products), buildStatusObject('HTTP_OK'), $this->lang);
        return printJson(new ProductCollection($products), buildStatusObject('HTTP_OK'), $this->lang);
        // return printJson(ProductResource::collection($products), buildStatusObject('HTTP_OK'), $this->lang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id);
        return printJson(new ProductResource($products), buildStatusObject('HTTP_OK'), $this->lang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
