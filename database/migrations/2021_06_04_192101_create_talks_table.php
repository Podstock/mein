<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('wishtime');
            $table->date('day')->nullable();
            $table->time('time')->nullable();
            $table->string('stage')->nullable();
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('record')->default(true);
            $table->string('streamurl')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('talks');
    }
}
