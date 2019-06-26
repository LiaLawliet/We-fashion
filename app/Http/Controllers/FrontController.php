<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $paginate = 6;
    
    public function __construct(){
        // méthode pour injecter des données à une vue partielle 
        view()->composer('partials.menu', function($view){
            $categories = Category::pluck('name', 'id')->all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('categories', $categories ); // on passe les données à la vue
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
    
    public function showByCategory(int $id){
        $category= Category::find($id);
        $products = $category->products()->where('status','=','published')->paginate($this->paginate); // on récupère tous les livres d'un auteur
        $nbproducts = count(Product::all()->where('category_id', '=', $id)->where('status','=','published'));
        return view('front.index', ['products' => $products, 'category' => $category,'nbproducts' => $nbproducts]);
    }
}
