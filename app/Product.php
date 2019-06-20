<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'description', 'genre_id'
    ];

    // ici le setter va récupérer la valeur à insérer en base de données
    // nous pourrons alors vérifier sa valeur avant que le modèle n'insère la donnée en base de données
    public function setGenreIdAttribute($value){
       
        if($value == 0){
            $this->attributes['genre_id'] = null;
        }else{

            $this->attributes['genre_id'] = $value;
        }

    }

    public function genres(){
        return $this->belongsTo(Genre::class);
    }
    
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }
}
