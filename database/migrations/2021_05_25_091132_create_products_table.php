<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name',100);
            $table->Text('description')->nullable();
            $table->decimal('price');

     

            

            $table->boolean('product_visible')->default(false);

            $table->boolean('state_product')->default(false);
            $table->string('reference',16);
            


            $table->timestamps();

           

      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
