<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use App\Task;
// fix

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('name');
            $table->string('job');
            $table->string('company')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type'); // kieu project ...
            $table->string('description')->default(' ');
            $table->integer('account_id')->unsigned();
            $table->string('participants'); // nguoi tham gia 
            $table->date('due_date')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner'); // nguoi tao
            $table->string('participants'); // nguoi tham gia => luu id ngu?i tham gia, phân cách = ,
            $table->date('due_date'); //ngay het han
            $table->integer('project_id')->unsigned(); //projectId
            $table->string('status'); // doing, done , ...
            $table->string('description')->default(' ');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();; //accountId
            $table->string('type')->default('text'); //text, image...
            $table->string('content');
            $table->integer('task_id')->unsigned();; //taskId
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });
        Schema::create('task_participants', function (Blueprint $table) {
            $table->integer('task_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('project_participants', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        //constraints
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
        });

        Schema::table('task_participants', function (Blueprint $table) {
            $table->primary(['task_id', 'account_id']);
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('account_id')->references('id')->on('accounts');
        });
        Schema::table('project_participants', function (Blueprint $table) {
            $table->primary(['project_id', 'account_id']);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('task_participants');
        Schema::dropIfExists('project_participants');
    }
}
