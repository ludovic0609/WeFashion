<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(UserTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(SizeTableSeeder::class);
        
        $this->call(ProductsTableSeeder::class);



       


    
       

        
    }
}
