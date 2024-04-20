<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',    'category_id	name',    'slug',    'description',    'image',
        'price',    'compare_price',    'options',    'rating',    'featured',    'status'
    ];

    public function Category()
    {
        return $this->belongsTo(Categorie::class,'category_id','id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tag()
    {
        return $this->belongsToMany;
    }



  // هده الدالة فقط لصاحب السطور بالتديل و حدف الخ
    protected static function booted()
    {
        static::addGlobalScope('store',function(Builder $builder){
            $user = Auth::user();
            if ($user->store_id) {
                $builder -> where('store_id','=',$user->store_id);
            }
            
        });
    }
}
