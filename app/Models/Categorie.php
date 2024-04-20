<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'parent_id','name','description','image','status','slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class,'parent_id','id')
        ->withDefault([
            'name' => '_'
        ]);
    }

    public function children()
    {
        return $this->hasMany(Categorie::class,'parent_id','id');
    }





    public function scopeActive(Builder $builder)
    {
        $builder -> where('status','=','active');
    }

    
    public function scopeFilter(Builder $builder,$filters)
    {
        $builder->when($filters['name'] ?? false, function($builder,$value){
            $builder->where('categories.name','like',"%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function($builder,$value){
            $builder->where('categories.status','=',$value);
        });

        /*
        methode two :
        if ($filters['name'] ?? false) {
            $builder->where('name','like',"%{$filters['name']}%");
        }
        if ( $filters['status'] ?? false) {
            $builder->where('status','=',$filters['status']);
        }
        */
        
    }


    public static function rules($id = 0)
    {
        return
        [
            'name'      => [
                'required','string','min:3','max:255',
                //unique:Categorie,name,$id
                Rule::unique('categories','name')->ignore($id)
                ],
            'parent_id' => [
                'nullable' ,'int', 'exists :categories,id'
            ],
            'image'  => [
                'image', 'max:10248576'
            ],
            'status' =>'required',

        ];
    }
}
