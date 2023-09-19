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
        Schema::create('risk_free_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('year_x');
            $table->decimal('yield',32,3);
            $table->integer('project_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->ipaddress('ipaddress')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('risk_free_rates');
    }
};
