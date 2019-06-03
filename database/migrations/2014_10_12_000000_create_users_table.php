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
            $table->string('accountId')->nullable();
            $table->string('participants'); // nguoi tham gia 
            $table->date('dueDate')->nullable();

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
        });


        DB::table('accounts')->insert(
            [
                'email' => 'long',
                'password' => Hash::make('1'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Bảo Long',
                'job' => 'Student pass 1',
                'company' => 'Pal'
            ]
        );
        DB::table('accounts')->insert(
            [
                'email' => 'quan',
                'password' => Hash::make('2'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Quân',
                'job' => 'Đồng đoàn pass 2',
                'company' => 'ko biet'
            ],
        );
        DB::table('accounts')->insert(
            [
                'email' => 'tongthang',
                'password' => Hash::make('3'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Thắng pass 3',
                'job' => 'óc chó',
                'company' => 'ko biet'
            ],
        );
        DB::table('accounts')->insert(
            [
                'email' => 'tuananh',
                'password' => Hash::make('4'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Anh pass 4',
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
