<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDreamContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dream_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_title');
            $table->string('section_sub_title');
            $table->string('section_block_one_title');
            $table->string('section_block_one_detail');
            $table->string('section_block_two_title');
            $table->string('section_block_two_detail');
            $table->string('section_block_three_title');
            $table->string('section_block_three_detail');
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
        Schema::dropIfExists('dream_contents');
    }
}
