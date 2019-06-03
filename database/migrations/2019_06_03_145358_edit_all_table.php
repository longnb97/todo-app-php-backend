<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {

            $table->increments('tasks_id');
            $table->string('owner'); // nguoi tao
            $table->string('participants'); // nguoi tham gia => luu id ngu?i tham gia, phân cách = ,
            $table->date('dueDate'); //ngay het han
            $table->string('projectId'); //projectId
            $table->string('status'); // doing, done , ...
            $table->string('description')->default(' ');

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);

        });

        Schema::table('comments', function (Blueprint $table) {

            $table->increments('comments_id');
            $table->string('accountId'); //accountId
            $table->string('type')->default('text'); //text, image...
            $table->string('content');
            $table->string('taskId'); //taskId
            $table->bigInteger('accounts_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);

        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->increments('accounts_id');
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

        Schema::table('projects', function (Blueprint $table) {

            $table->increments('projects_id');
            $table->string('name');
            $table->string('type'); // kieu project ...
            $table->string('description')->default(' ');
            $table->string('accountId')->nullable();
            $table->string('participants'); // nguoi tham gia  => bỏ
            $table->date('dueDate')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
