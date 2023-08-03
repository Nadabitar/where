<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('subCategoryId')->nullable();
            $table->unsignedBigInteger('regionId')->nullable();
            $table->unsignedBigInteger('streetId')->nullable();
            $table->string('placeName');
            $table->string('phone');
            $table->string('details')->nullable();
            $table->string('workTime');
            $table->string('image')->nullable();
            $table->json('links')->nullable();
            $table->double('latitud')->nullable();
            $table->double('longitude')->nullable();
            $table->double('rate' , 5 ,2)->nullable();
            $table->boolean('isAccepted')->nullable();
            $table->foreign('regionId')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('streetId')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('categoryId')->references('id')->on('categoris')->onDelete('cascade');
            $table->foreign('subCategoryId')->references('id')->on('categoris')->onDelete('cascade');
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
        Schema::dropIfExists('places');
    }
}
