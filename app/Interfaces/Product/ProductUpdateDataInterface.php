<?php

declare(strict_types=1);

namespace App\Interfaces\Product;

interface ProductUpdateDataInterface extends ProductDataInterface
{
    public function getId(): int|string;
}
