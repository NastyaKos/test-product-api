<?php

declare(strict_types=1);

namespace App\Http\Requests;

trait ProductRequestTrait
{
    public function getName(): string
    {
        return $this->input('name');
    }

    public function getPrice(): int
    {
        return $this->input('price');
    }

    public function isEnabled(): bool
    {
        return $this->input('enabled', true);
    }

    public function getSlug(): ?string
    {
        return $this->input('slug');
    }
}
