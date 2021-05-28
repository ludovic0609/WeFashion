<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedInteger('category_id')->nullable(); // UNSIGNED INTEGER un livre peut ne pas avoir de genre
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL'); // Contrainte référencé sur la table categories.id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropForeign('products_category_id_foreign');
            $table->dropColumn('category_id');

            

            
        });
    }
}
