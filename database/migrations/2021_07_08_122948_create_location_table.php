<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->string('title')->length(255)->nullable();
            $table->string('address')->length(255)->nullable();
            $table->string('lat')->length(255)->nullable();
            $table->string('long')->length(255)->nullable();
            $table->string('phone_number')->length(255)->nullable();
            $table->text('shortdescription')->nullable();
            $table->string('image')->length(255)->nullable();
            $table->string('video_url')->length(255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
}
