<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderIdAndFoodIdToOrderFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_food_items', function (Blueprint $table) {

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')
                  ->references('id')->on('food_items')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_food_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['food_id']);
            $table->dropColumn('order_id');
            $table->dropColumn('food_id');
        });
    }
}
