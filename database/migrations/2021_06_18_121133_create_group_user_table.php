<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        
        //
        Schema::create('model_role_user', function (Blueprint $table) use ($tableNames){
            $table->unsignedBigInteger('user_id');
            $table->morphs('model');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','model_id','model_type','role_id']);
            $table->unique(['model_id','model_type','user_id']);
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on($tableNames['roles'])->onDelete('cascade');
        });
        //
        Schema::create('join_requests', function (Blueprint $table) use ($tableNames){
            $table->unsignedBigInteger('user_id');
            $table->morphs('model');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','model_id','model_type','role_id']);
            $table->unique(['model_id','model_type','user_id']);
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on($tableNames['roles'])->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_role_user');
        Schema::dropIfExists('join_requests');
    }
}
