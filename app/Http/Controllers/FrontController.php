<?php

namespace App\Http\Controllers;
use App\Product;
use App\Genre;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $paginate = 6;
    
    public function __construct(){

        // méthode pour injecter des données à une vue partielle 
        view()->composer('partials.menu', function($view){
            $genres = Genre::pluck('name', 'id')->all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('genres', $genres ); // on passe les données à la vue
        });
    }

    public function index(){
        $products = Product::paginate($this->paginate); // pagination 

        return view('front.index', ['products' => $products]);
    }
 
    public function item(int $id){
        return Product::find($id);
    }
    
    public function homme(int $genre_id){
        return Product::find()->where('genre_id',$genre_id);
    }
}
