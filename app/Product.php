<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'description', 'category_id','price','picture','status','sales','reference'
    ];

    // ici le setter va récupérer la valeur à insérer en base de données
    // nous pourrons alors vérifier sa valeur avant que le modèle n'insère la donnée en base de données
    public function setCategoryIdAttribute($value){
       
        if($value == 0){
            $this->attributes['category_id'] = null;
        }else{

            $this->attributes['category_id'] = $value;
        }

    }

    /**
     * Get the published element
     * @param $query
     * @return mixed
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function size(){
        return $this->belongsToMany(Size::class);
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }
    /**
     * Get the on sales element
     * @param $query
     * @return mixed
     */
    public function scopeSales($query){
        return $query->where('sales', 'onSales');
    }
    /**
     * Get the catagory depending of the id
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeCategories($query, $id){
        return $query->where('category_id', $id);
    }
}
