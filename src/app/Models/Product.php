<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'price', 'image', 'description'];

    public function scopeSearchByName($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}
