<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wage_indices', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->enum('type',['m','i','t','a','fi','re','pb','ps','all'])->default('m');
            $table->decimal('index',32,3)->nullable();
            $table->integer('created_by');
            $table->softDeletes();
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
        Schema::dropIfExists('wage_indices');
    }
};
