<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Illuminate\Support\Facades\Date;

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

            $table->increments('taskId');
            $table->string('owner'); // nguoi tao
            $table->string('participants'); // nguoi tham gia => luu id ngu?i tham gia, phân cách = ,
            $table->date('dueDate'); //ngay het han
            $table->string('projectId'); //projectId
            $table->string('status'); // doing, done , ...
            $table->string('description')->default(' ');

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('comments', function (Blueprint $table) {

            $table->increments('commentId');
            $table->string('accountId'); //accountId
            $table->string('type')->default('text'); //text, image...
            $table->string('content');
            $table->string('taskId'); //taskId

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('accountId');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();

            $table->string('name');
            $table->string('job');
            $table->string('company')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('projects', function (Blueprint $table) {

            $table->increments('projectId');
            $table->string('name');
            $table->string('type'); // kieu project ...
            $table->string('description')->default(' ');
            $table->string('accountId')->nullable();
            $table->string('participants'); // nguoi tham gia 
            $table->date('dueDate')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        // Schema::table('account', function (Blueprint $table) {
        //     $table->foreign('project')->references('projectId')->on('projects');
        //     $table->string('accountType');
        //     $table->string('comment');
        //     $table->foreign('comment')->references('commentId')->on('comments');
        // });

        // Schema::table('projects', function (Blueprint $table) {

        //     $table->string('comment')->nullable();
        //     $table->foreign('comment')->references('commentId')->on('comments');

        //     $table->string('account')->nullable();
        //     $table->foreign('account')->references('accountId')->on('accounts');

        //     $table->string('owner');
        //     $table->foreign('owner')->references('accountId')->on('accounts');

        //     $table->string('task')->nullable();
        //     $table->foreign('task')->references('taskId')->on('tasks');
        // });

        DB::table('accounts')->insert(
            [
                'email' => 'long',
                'password' => '123',
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Bảo Long',
                'job' => 'Student',
                'company' => 'Pal'
            ]
        );
        DB::table('accounts')->insert(
            [
                'email' => 'quan',
                'password' => '123',
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Quân',
                'job' => 'Đồng đoàn',
                'company' => 'ko biet'
            ],
        );
        DB::table('accounts')->insert(
            [
                'email' => 'tongthang',
                'password' => '123',
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Thắng',
                'job' => 'óc chó',
                'company' => 'ko biet'
            ],
        );
        DB::table('accounts')->insert(
            [
                'email' => 'tuananh',
                'password' => '123',
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Anh',
                'job' => 'óc',
                'company' => 'Icheck'
            ],
        );
        DB::table('projects')->insert(
            [
                'name' => 'DO AN PHP',
                'type' => 'homework',
                'description' => 'Co gang lam 1 to do app',
                'accountId' => '1',
                'participants' => '1;2;3',
                'dueDate' => '2017-05-03'
            ],
        );
        DB::table('projects')->insert(
            [
                'name' => 'DO AN Tot nghiep',
                'type' => 'university project',
                'description' => 'chìa khóa ra trường, làm gì h',
                'accountId' => '2',
                'participants' => '1;2;3;4',
                'dueDate' => '2018-05-03'
            ],
        );
        DB::table('comments')->insert(
            [
                'accountId' => '1',
                //'type' => 'text',
                'content' => 'lam ngu vcl, dap hết đi làm lại đê',
                'taskId' => '1',
            ],
        );
        DB::table('comments')->insert(
            [
                'accountId' => '2',
                //'type' => 'text',
                'content' => 'ok để em làm lại ',
                'taskId' => '1',
            ],
        );
        DB::table('comments')->insert(
            [
                'accountId' => '2',
                //'type' => 'text',
                'content' => 'tóc đẹp không',
                'taskId' => '2',
            ],
        );
        DB::table('comments')->insert(
            [
                'accountId' => '1',
                //'type' => 'text',
                'content' => 'đầu tóc như cái lông chồn',
                'taskId' => '2',
            ],
        );
        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'participants' => '1;2;3',
                'dueDate' => '2018-05-03',
                'projectId' => '1',
                'status' => 'doing',
                'description' => 'làm đồ án phần backend'
            ],
        );
        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'participants' => '1',
                'dueDate' => '2018-05-03',
                'projectId' => '1',
                'status' => 'doing',
                'description' => 'chơi'
            ],
        );
        DB::table('tasks')->insert(
            [
                'owner' => '2',
                'participants' => '1;2',
                'dueDate' => '2019-05-03',
                'projectId' => '2',
                'status' => 'done',
                'description' => 'học bài'
            ],
        );
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
