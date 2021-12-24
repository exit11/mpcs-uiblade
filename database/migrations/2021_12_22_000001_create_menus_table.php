<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('parent_id')->nullable()->index();
            $table->unsignedTinyInteger('order')->default(0);
            $table->string('name', 100)->index();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('url', 512)->nullable();
            $table->boolean('target')->default(0);
            $table->string('background_image')->nullable();
            $table->boolean('is_visible')->default(0);
            $table->unsignedTinyInteger('depth')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
