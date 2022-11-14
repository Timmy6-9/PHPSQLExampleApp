<?php

use Illuminate\Database\Console\Seeds\SeedCommand;
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
        Schema::create('testCo', function(Blueprint $table){
            $table->id();
            $table->string('CustomerName');
            $table->string('CustomerEmail');
            $table->string('CustomerAddress');
            $table->string('MainContactName');
            $table->string('MainContactPhone');
        });

        Artisan::call('db:seed');
        Artisan::call('db:seed');
        Artisan::call('db:seed');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testCo');
    }
};
