<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //une taille peut appartenir à plusieurs produits
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
