<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function activeCategories()
    {
        return Category::where('status', 1)->get();
    }

    public static function inactiveCategories()
    {
        return Category::where('status', 0)->get();
    }

    public static function allCategories()
    {
        return  Category::simplePaginate(50);
    }

    public static function allCategoryNames()
    {
        return Category::where('status', 1)->get();
    }

    public function path()
    {
        return url("/catalog/{$this->id}-" . Str::slug($this->name));
    }
}
