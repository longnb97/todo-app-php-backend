<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            Schema::dropIfExists('tasks');
            $table->increments('id');
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

        Schema::create('comments', function (Blueprint $table) {
            Schema::dropIfExists('projects');
            $table->increments('id');
            $table->string('accountId'); //accountId
            $table->string('type')->default('text'); //text, image...
            $table->string('content');
            $table->string('taskId'); //taskId

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });

        Schema::create('accounts', function (Blueprint $table) {
            Schema::dropIfExists('accounts');
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
            Schema::dropIfExists('comments');
            $table->increments('id');
            $table->string('name');
            $table->string('type'); // kieu project ...
            $table->string('description')->default(' ');
            $table->string('accountId')->nullable();
            $table->string('participants'); // nguoi tham gia 
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
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('comments');
    }
}
