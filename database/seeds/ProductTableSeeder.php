<?php

use Illuminate\Database\Seeder;
use App\Genre;
use App\Size;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création de 80 produits à partir de la factory
        factory(App\Product::class, 80)->create()->each(function($product){
            $RNG = rand(1, 2);

            $randGenre = Genre::find($RNG);

            $product->genre()->associate($randGenre);

            $images=glob(public_path().'/img/'.$RNG.'/*');
            $imagesRNG = $images[array_rand($images)];

            $product->picture = basename($imagesRNG);

            $sizes = Size::pluck('id')->shuffle()->slice(0, rand(1,5))->all();

            $product->size()->attach($sizes);

            $product->save();
        });
    }
}
