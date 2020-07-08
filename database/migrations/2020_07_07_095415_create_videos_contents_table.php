<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_sub_title');
            $table->string('section_title');
            $table->string('section_button_text');
            $table->string('section_button_url');
            $table->string('section_foreground_image');
            $table->string('section_video_mp4');
            $table->string('section_video_webm');
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
        Schema::dropIfExists('videos_contents');
    }
}
