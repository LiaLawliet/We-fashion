<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([// creation de deux catégories au moment de la migration
            [
                'name' => 'Homme',
            ],
            [
                'name' => 'Femme',
            ]
        ]);
    }
}
