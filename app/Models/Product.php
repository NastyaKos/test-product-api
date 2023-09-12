<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int                    $id
 * @property string                 $name
 * @property string                 $slug
 * @property int                    $price
 * @property bool                   $enabled
 * @property DateTimeInterface|null $createdAt
 * @property DateTimeInterface|null $updatedAt
 */
class Product extends Model
{
    use HasFactory;
}
