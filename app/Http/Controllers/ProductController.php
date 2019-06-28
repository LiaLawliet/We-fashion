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
        $catgories = Category::pluck('name','id')->all();
        return view('back.product.create',['sizes'=>$sizes,'catgories'=>$catgories]);
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
            'category_id' => 'required|integer',
            'sizes' => 'required'
        ]);

        $datas = $request->all();

        // hash image name
        
        $imageName = $request->picture->hashName();
        $datas['picture'] = $imageName;

        // store the image
        $categoryId = $datas['category_id'];
        $img = $request->file('picture');
        $img->move(public_path('/img/'.$categoryId),$datas['picture']);

        // insert the datas inside the database
        $product = Product::create($datas);
        $product->size()->attach($request->sizes);
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
        if(!empty($file)){
            $imageName = $request->picture->hashName();
            $datas['picture'] = $imageName;

            $categoryId = $datas['category_id'];
            $img = $request->file('picture');
            $img->move(public_path('/img/'.$categoryId),$datas['picture']);
        }else{
            if($product->category_id != $datas['category_id']){
                $newCategoryId = $datas['category_id'];
                $oldPath = public_path('/img/'.$product->category_id.'/'.$product->picture);
                $newPath = public_path('/img/'.$newCategoryId.'/'.$product->picture);
                File::move($oldPath,$newPath);
            }
            
        }

        
        $product->update($datas);
        $product->size()->sync($request->sizes);

        return redirect()->route('product.index')->with('message', 'Le produit a bien été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
