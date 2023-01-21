<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('name');
            $table->string('image_url');
            $table->boolean('is_closed')->default(false);
            $table->string('url');
            $table->integer('review_count');
            $table->text('categories');
            $table->decimal('rating');
            $table->text('coordinates');
            $table->text('transactions');
            $table->integer('price');
            $table->text('location');
            $table->string('phone');
            $table->string('display_phone');
            $table->integer('distance');
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
        Schema::dropIfExists('businesses');
    }
}
