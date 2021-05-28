<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         // création des categories
       App\Category::create([
        'name' => 'hommes'
    ]);
    App\Category::create([
        'name' => 'femmes'
    ]);
    }
}
