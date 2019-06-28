<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Category;
use File;

class ProductController extends Controller
{

    protected $paginate = 10;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate($this->paginate); // On récupère les produits

        return view('back.product.index', ['products' => $products]);  // On les envois à la page admin des produits
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::pluck('name','id')->all();
        $catgories = Category::pluck('name','id')->all();

        //Redirection vers la page de création d'un produit
        return view('back.product.create',['sizes'=>$sizes,'catgories'=>$catgories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Fonction d'ajout d'un produit
    {
        // Validation des données du formulaire
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'required|image:max:3000',
            'status' => 'required|in:published,unpublished',
            'sales' => 'required|in:onSales,standard',
            'reference' => 'required|alpha_num|min:16|max:16',
            'category_id' => 'required|integer',
            'sizes' => 'required'
        ]);

        $datas = $request->all();

        
        $imageName = $request->picture->hashName(); //hashage du nom de l'image à enregistrer
        $datas['picture'] = $imageName;

        $categoryId = $datas['category_id'];
        $img = $request->file('picture');
        $img->move(public_path('/img/'.$categoryId),$datas['picture']);// insertion de l'image dans le dossier de catégorie choisie

        $product = Product::create($datas); // Insertion d'un nouveau produit dans la BDD
        $product->size()->attach($request->sizes);

        //Redirection vers la page admin des produits
        return redirect()->route('product.index')->with('message', 'Le produit a bien été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // Fonction de modification d'un produit
    {
        $product = Product::find($id);
        $categories = Category::pluck('name', 'id')->all();
        $sizes = Size::pluck('name', 'id')->all();

        return view('back.product.edit', ['product' => $product, 'categories' => $categories, 'sizes' => $sizes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'image:max:3000',
            'status' => 'required|in:published,unpublished',
            'sales' => 'required|in:onSales,standard',
            'reference' => 'required|alpha_num|min:16|max:16',
            'category_id' => 'required|integer',
            'sizes' => 'required'
        ]);

        $product = Product::find($id);
        
        $datas = $request->all();

        $file = $request->file('picture');
        if(!empty($file)){ // si l'utilisateur ne change pas son image
            $imageName = $request->picture->hashName(); //hashage du nom de l'image à enregistrer
            $datas['picture'] = $imageName;

            $categoryId = $datas['category_id'];
            $img = $request->file('picture');
            $img->move(public_path('/img/'.$categoryId),$datas['picture']);// insertion de l'image dans le dossier de catégorie choisie
        }else{
            if($product->category_id != $datas['category_id']){ // si l'utilisateur change de catégorie
                $newCategoryId = $datas['category_id'];
                $oldPath = public_path('/img/'.$product->category_id.'/'.$product->picture);
                $newPath = public_path('/img/'.$newCategoryId.'/'.$product->picture);
                File::move($oldPath,$newPath);// insertion de l'image dans le dossier de catégorie choisie
            }
            
        }

        
        $product->update($datas);
        $product->size()->sync($request->sizes);

        //Redirection vers la page admin des produits
        return redirect()->route('product.index')->with('message', 'Le produit a bien été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // Fonction de suppression d'un produit
    {
        $product = Product::find($id);// on récupère le produit à supprimer
        $product->delete(); // On le supprime

        //Redirection vers la page admin des produits
        return redirect()->route('product.index');
    }
}
