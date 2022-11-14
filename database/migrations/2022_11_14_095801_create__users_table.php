<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UserTable;
return new class extends Migration
{
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Username')->unique();
            $table->string('Password');
            $table->string('EmailAddress')->unique();
            $table->string('Organization')->unique();
            $table->string('updated_at');
            $table->string('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Users');
    }
};
