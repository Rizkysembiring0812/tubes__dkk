<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id');
    }

    public function getQuestions()
    {
        return $this->hasMany('App\Models\CustomerQuestion');
    }

    public function scopeMinPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '>=', (int)$price);
    }

    public function scopeMaxPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '<=', (int) $price);
    }

    public function path()
    {
        return url("/shop/{$this->id}-" . Str::slug($this->title));
    }
}
