<?php

declare(strict_types=1);

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;

interface ProductRepositoryInterface
{
    public function findAll(): array;

    public function find(string|int $id): ?Product;

    public function findOneBySlug(string $slug): ?Product;

    public function save(Product $product): bool;

    public function findAllWithPaginate(int $page, ?int $count = null): Paginator;

    public function remove(string|int $id): bool;
}
