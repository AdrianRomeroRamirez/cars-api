<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
