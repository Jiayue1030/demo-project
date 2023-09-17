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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('staff_no')->nullable();
            $table->string('project_id')->nullable();
            $table->enum('gender',['M','F'])->default('M');
            $table->enum('status',['pending','disabled','active'])->default('active');
            $table->date('birthday')->nullable();
            $table->date('date_of_join')->nullable();
            $table->double('monthly_income',32,2)->nullable();
            $table->double('bonus',32,2)->nullable();
            $table->double('adjusted_monthly_income',32,2)->nullable();
            $table->double('monthly_wage',32,2)->nullable();
            $table->double('gratuities_paid',32,2)->nullable();
            $table->double('mandatory_mpf_benefits',32,2)->nullable();
            $table->double('voluntary_mpf_benefits',32,2)->nullable();
            $table->double('employer_contribution',32,2)->nullable();
            $table->string('department')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
