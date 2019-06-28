<?php

namespace App\Http\Controllers;
use App\Category;
use File;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $paginate = 15;

    public function index()
    {
        $categories = Category::paginate($this->paginate); // On récupère les catégories

        return view('back.categories.index', ['categories' => $categories]); // On les envois à la view admin de catégorie
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Fonction d'ajout de catégorie
    {
        // Validation des données du formulaire
        $this->validate($request, [ 
            'name' => 'required|min:5|max:100'
        ]);

        
        
        $datas = $request->all();
        $category = Category::create($datas); // Insertion d'une nouvelle catégorie dans la BDD
        $path = public_path().'/img/'.$category->id;
        File::makeDirectory($path); // Création d'un dossier d'image dédié à la catégorie
        
        // On retourne à la page de gestion des catégories
        return redirect()->route('categories.index')->with('message', 'La catégorie a bien été mise à jour'); 
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Fonction de modification de catégorie
    {
        // Validation des données du formulaire
        $this->validate($request, [
            'name' => 'required|min:5|max:100'
        ]);

        $category = Category::find($id); // On retrouve la catégorie à modifier
        
        $datas = $request->all();

        $category->update($datas);  // Modification d'une catégorie dans la BDD

        
        // On retourne à la page de gestion des catégories
        return redirect()->route('categories.index')->with('message', 'La catégorie a bien été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id); // On retrouve la catégorie à supprimer
        $category->delete(); // Suppression d'une catégorie dans la BDD
        return redirect()->route('categories.index');// On retourne à la page de gestion des catégories
    }
}
