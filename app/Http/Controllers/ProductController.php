<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Genre;

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
        $products = Product::paginate($this->paginate);

        return view('back.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::pluck('name','id')->all();
        $genres = Genre::pluck('name','id')->all();
        return view('back.product.create',['sizes'=>$sizes,'genres'=>$genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'required|image:max:3000',
            'status' => 'required|in:published,unpublished',
            'sales' => 'required|in:onSales,standard',
            'reference' => 'required|alpha_num|min:16|max:16',
            'genre_id' => 'required|integer',
            'sizes' => 'required'
        ]);

        // image
        $im = $request->file('picture');
        if(!empty($im)){
            $im->store('products');
        }

        $imgName = $request->picture->hashName();

        // store the datas && rewrite "$datas['picture']" as a path
        $datas = $request->all();
        $datas['picture'] =  'products/' . $imgName;

        // insert the datas inside the database
        $product = Product::create($datas);
        $product->size()->attach($request->sizes);
        return redirect()->route('product.index')->with('message', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('back.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
