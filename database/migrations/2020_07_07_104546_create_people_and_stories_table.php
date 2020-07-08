<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleAndStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_and_stories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_sub_title');
            $table->string('section_title');
            $table->string('section_description');
            $table->string('module_status');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            
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
        Schema::dropIfExists('people_and_stories');
    }
}
