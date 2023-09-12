<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Exceptions\Product\ProductCreateException;
use App\Exceptions\Product\ProductDeleteException;
use App\Exceptions\Product\ProductUpdateException;
use App\Interfaces\Product\ProductCreateDataInterface;
use App\Interfaces\Product\ProductDataInterface;
use App\Interfaces\Product\ProductUpdateDataInterface;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private SluggerInterface $slugger,
    ) {}

    public function create(ProductCreateDataInterface $productDTO): Product
    {
        $product = new Product();

        $this->updateProduct($product, $productDTO);

        if ($this->productRepository->save($product)) {
            return $product;
        }

        throw new ProductCreateException('Somewhere error with save.');
    }

    public function update(ProductUpdateDataInterface $productDTO): Product
    {
        if (!$product = $this->productRepository->find($productDTO->getId())) {
            throw (new ModelNotFoundException())->setModel(Product::class, $productDTO->getId());
        }

        $product = $this->updateProduct($product, $productDTO);

        if ($this->productRepository->save($product)) {
            return $product;
        }

        throw new ProductUpdateException('Somewhere error with save.');
    }

    public function list(?int $page = null, ?int $count = null): Paginator|array
    {
        if ($page) {
            return $this->productRepository->findAllWithPaginate($page, $count);
        }

        return $this->productRepository->findAll();
    }

    public function remove(string|int $id): void
    {
        if (!$this->productRepository->remove($id)) {
            throw new ProductDeleteException('Somewhere error with delete.');
        }
    }

    public function get(string|int $id): Product
    {
        // trying find by slug
        if (!$product = $this->productRepository->findOneBySlug($id)) {
            $product = $this->productRepository->find($id);
        }

        if ($product) {
            return $product;
        }

        throw (new ModelNotFoundException())->setModel(Product::class, $id);
    }

    protected function updateProduct(Product $product, ProductDataInterface $productDTO): Product
    {
        $product->name = $productDTO->getName();
        $product->price = $productDTO->getPrice();
        $product->enabled = $productDTO->isEnabled();

        if (!$slug = $productDTO->getSlug()) {
            $slug = $product->slug ?? $this->slugger->slug($productDTO->getName());
        }

        $product->slug = $slug;

        return $product;
    }
}
