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
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique()->nullable();
            
            $table->time('start')->nullable();
            $table->time('end')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('services_id');
            $table->unsignedBigInteger('worktime_id')->nullable();
            $table->unsignedBigInteger('Turn_id')->nullable();
            $table->date('date');
            
            $table->integer('status')->default('0');
            $table->integer('capacity')->default('1');

            
            $table->foreign('user_id')->references('id')->on('my_users');
            $table->foreign('services_id')->references('id')->on('services');
            $table->foreign('worktime_id')->references('id')->on('worktime');
            $table->foreign('Turn_id')->references('id')->on('turns');

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
        Schema::dropIfExists('turns');
    }
};
