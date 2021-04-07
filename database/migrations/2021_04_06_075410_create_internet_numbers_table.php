<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('omzetting_id')->constrained('omzettings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('internet_number');
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
        Schema::dropIfExists('internet_numbers');
    }
}
