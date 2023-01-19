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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();
            $table->date('birth')->nullable();
            $table->string('street', 255)->nullable();
            $table->string('number', 10)->nullable()->nullable();
            $table->string('complement', 50)->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->dateTime('registration_date')->useCurrent();
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
        Schema::dropIfExists('customers');
    }
};
