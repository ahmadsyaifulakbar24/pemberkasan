<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('params', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->string('category_param');
            $table->string('param');
            $table->integer('order');
            $table->boolean('active');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('file_managers', function (Blueprint $table) {
            $table->foreign('status_project_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_file_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('params');
    }
}
