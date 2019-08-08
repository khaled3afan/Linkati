<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('projects', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBigInteger('profile_id');
//            $table->string('name')->nullable();
//            $table->string('slug')->index();
//            $table->text('bio')->nullable();
//            $table->integer('views')->default(0);
//
//            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
//            $table->timestamps();
//        });
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
}
