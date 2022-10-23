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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('verificator_id')->nullable();
            $table->tinyInteger('procedure_type');
            $table->tinyInteger('promotion_type');
            $table->tinyInteger('job_type');
            $table->tinyInteger('status');
            $table->date('proposal_date');
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
        Schema::dropIfExists('promotions');
    }
};
