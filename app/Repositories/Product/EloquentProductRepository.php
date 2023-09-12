<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;

final class EloquentProductRepository implements ProductRepositoryInterface
{
    public function findAll(): array
    {
        return Product::query()
            ->where('enabled', '=', true)
            ->get();
    }

    public function find(int|string $id): ?Product
    {
        return Product::query()
            ->find($id)
            ->where('enabled', '=', true)
            ->first();
    }

    public function findOneBySlug(string $slug): ?Product
    {
        return Product::query()
            ->where('slug', '=', $slug)
            ->where('enabled', '=', true)
            ->get()
            ->first();
    }

    public function findAllWithPaginate(int $page, ?int $count = null): Paginator
    {
        return Product::query()
            ->where('enabled', '=', true)
            ->paginate(perPage: $count, page: $page);
    }

    public function save(Product $product): bool
    {
        return $product->save();
    }

    public function remove(int|string $id): bool
    {
        return (bool)$this->find($id)?->delete();
    }
}
