<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TentsExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tents', function (Blueprint $table) {
            $table->unsignedInteger('number')->unique()->change();
            $table->string('image_inside')->nullable();
            $table->string('title')->nullable();
            $table->boolean('visible')->default(true);
            $table->string('custom_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tents', function (Blueprint $table) {
            //
        });
    }
}
