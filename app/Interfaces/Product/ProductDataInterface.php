<?php

declare(strict_types=1);

namespace App\Interfaces\Product;

interface ProductDataInterface
{
    public function getName(): string;

    public function getPrice(): int;

    public function isEnabled(): bool;

    public function getSlug(): ?string;
}
