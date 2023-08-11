<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('placeId');
            $table->string('title');
            $table->boolean('isAd')->default(false);
            $table->boolean('isPromo')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->text('content');
            $table->boolean('status')->default(true);
            $table->integer('count')->nullable()->default(0); 

            
            $table->foreign('placeId')->references('id')->on('places')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
