<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $connection = 'mysql';// tahdid ay database lighant3amlo m3aha

    protected $table = 'stores';
    
    protected $primaryKey = 'id';   //tahdid PK fi Halat makanch ismo id ----K-> Capital letter

    public $incrementing = true;    //fi halat kan had table id mafihch auto_increment

    public $timestamps = true;       //fi halat kan had champ anuler

    public function products()
    {
        return $this->hasMany(Product::class,'store_id','id');
    }
    

}
