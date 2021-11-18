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
        /*
        Schema::create('group_role_user', function (Blueprint $table) use ($tableNames){
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','group_id','role_id']);
            $table->unique(['group_id','user_id']);
            $table->timestamps();
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on($tableNames['roles'])->onDelete('cascade');
        });

        Schema::create('group_join_requests', function (Blueprint $table) use ($tableNames){
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('role_id');
            $table->index(['user_id','group_id','role_id']);
            $table->unique(['group_id','user_id']);
            $table->timestamps();
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on($tableNames['roles'])->onDelete('cascade');
        });*/

        Schema::create('extra_group_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->index(['user_id','group_id']);
            $table->unique(['name','group_id','user_id']);
            $table->timestamps();
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });



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
        //Schema::dropIfExists('group_role_user');
        //Schema::dropIfExists('group_join_requests');
        Schema::dropIfExists('extra_group_users');

        Schema::dropIfExists('model_role_user');
        Schema::dropIfExists('join_requests');
    }
}
