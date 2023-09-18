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
        Schema::create('projected_lives', function (Blueprint $table) {
            $table->id();
            $table->enum('gender',['M','F'])->default('M');
            $table->integer('year');
            $table->integer('x');
            $table->decimal('qx',32,8);
            $table->integer('lx');
            $table->integer('dx');
            $table->integer('l_x');
            $table->integer('t_x');
            $table->decimal('ex',32,2);
            $table->integer('project_id')->nullable();
            $table->integer('created_by');
            $table->ipaddress('ipaddress');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projected_lives');
    }
};
