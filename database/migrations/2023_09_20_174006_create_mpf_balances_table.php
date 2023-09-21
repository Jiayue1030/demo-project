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
        Schema::create('mpf_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('year'); //TODO: default value = last year
            $table->enum('type',['mandatory','voluntary'])->default('mandatory');
            $table->enum('department',['SGM','LKH','LY','LKI','PMT'])->default('SGM');
            $table->integer('project_id')->nullable();
            $table->decimal('value',32,2)->nullable();
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
        Schema::dropIfExists('mpf_balances');
    }
};
