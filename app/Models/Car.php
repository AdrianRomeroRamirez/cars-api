<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'year', 'engine_type', 'description'];

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }
}
