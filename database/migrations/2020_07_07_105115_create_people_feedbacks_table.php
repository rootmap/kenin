<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->string('feedback');
            $table->string('feedback_author');
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
        Schema::dropIfExists('people_feedbacks');
    }
}
