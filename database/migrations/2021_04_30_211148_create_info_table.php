<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('model');
            $table->timestamps();
            $table->unique(['name','model']);
        });

        Schema::create('info_bases', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedInteger('index');
            $table->unsignedInteger('info_template_id');
            $table->morphs('model');
            $table->unique(['index','model_id','model_type']);
            $table->timestamps();
            $table->boolean('viewable')->default(true);
            $table->string('edit');
            $table->string('name');
            //
            $table->foreign('info_template_id')->references('id')->on('info_templates');
        });

        Schema::create('infos', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->unsignedBigInteger('info_base_id')->index();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->text('info');
            //
            $table->foreign('info_base_id')->references('id')->on('info_bases');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
        Schema::dropIfExists('info_bases');
        Schema::dropIfExists('info_templates');
    }
}
