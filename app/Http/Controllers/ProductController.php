<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response|JsonResponse
     */
    public function index(Request $request): Response|JsonResponse
    {
        return new JsonResponse(
            ProductResource::collection(
                $this->productService->list(
                    $request->query->get('page'),
                    $request->query->get('count')
                )
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|JsonResponse
     */
    public function create(): Response|JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     *
     * @return Response|JsonResponse
     */
    public function store(StoreProductRequest $request): Response|JsonResponse
    {
        return new JsonResponse(ProductResource::make($this->productService->create($request)));
    }

    /**
     * Display the specified resource.
     *
     * @param string|int $id
     *
     * @return Response|JsonResponse
     */
    public function show(string|int $id): Response|JsonResponse
    {
        return new JsonResponse(ProductResource::make($this->productService->get($id)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     *
     * @return Response|JsonResponse
     */
    public function edit(Product $product): Response|JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     *
     * @return Response|JsonResponse
     */
    public function update(UpdateProductRequest $request): Response|JsonResponse
    {
        return new JsonResponse(ProductResource::make($this->productService->update($request)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string|int $id
     *
     * @return Response|JsonResponse
     */
    public function destroy(string|int $id): Response|JsonResponse
    {
        $this->productService->remove($id);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
