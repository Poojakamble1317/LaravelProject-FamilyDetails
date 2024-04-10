<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_head_models', function (Blueprint $table) {
            //name,surname,
            // birthdate > 21 acceptable
            //mobile no
            //address
            //state - dropdown
            //city - dropdown //https://github.com/emmamartins/Countries-States-Cities-SQL-Database
            //pincode
            //marital status radio - if married - wedding date
            //hobbies - add hobby button
            //photo
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->string('mobile_no');
            $table->text('address');
            $table->string('pincode');
            $table->integer('stateId');
            $table->integer('cityId');
            $table->string('marital_status')->default('Unmarried');
            $table->string('wedding_date')->nullable();
            $table->string('hobbies');
            $table->string('photo');
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_head_models');
    }
};
