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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client_id')->nullable();
            $table->string('valuation_target')->default('Long Service Payment Valuation');
            $table->string('ref_num')->nullable();
            $table->date('valuation_date');
            $table->double('sum_long_service_payment',32,2)->nullable();
            $table->double('max_long_service_payment',32,2)->nullable();
            $table->double('max_monthly_employer_contribution',32,2)->nullable();
            $table->double('net_annual_return_mpfasset',32,2)->nullable();
            $table->enum('status',['disabled','ongoing','done'])->default('ongoing');
            $table->integer('created_by')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->decimal('wage_growth',32,2)->default(0);
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
        Schema::dropIfExists('projects');
    }
};
