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
        $products = Product::all()->where('status','=','published');
        $nbproducts = count(Product::all()->where('status','=','published'));

        return view('front.index', ['products' => $products, 'nbproducts' => $nbproducts]);
    }
 
    public function show(int $id){
        $product= Product::find($id);

        return view('front.show', ['product' => $product]);
    }
    
    public function showByGenre(int $id){
        $genre= Genre::find($id); // récupérez les informations liés à l'auteur
        $products = $genre->products()->where('status','=','published')->paginate($this->paginate); // on récupère tous les livres d'un auteur
        $nbproducts = count(Product::all()->where('genre_id', '=', $id)->where('status','=','published'));
        return view('front.index', ['products' => $products, 'genre' => $genre,'nbproducts' => $nbproducts]);
    }
}
