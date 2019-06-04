<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// merge vs dev
// merge vs dev 1
class InsertData extends Migration
{
    /**`
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            ]
        );

        DB::table('accounts')->insert(
            [
                'email' => 'tongthang',
                'password' => Hash::make('3'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Thắng pass 3',
                'job' => 'óc chó',
                'company' => 'ko biet'  
            ]
        );
        // check
        DB::table('accounts')->insert(
            [
                'email' => 'tuananh',
                'password' => Hash::make('4'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Anh pass 4',
                'job' => 'óc',
                'company' => 'Icheck'
            ]
        );
        DB::table('projects')->insert(
            [
                'name' => 'DO AN PHP',
                'type' => 'homework',
                'description' => 'Co gang lam 1 to do app',
                'account_id' => 2,
                'participants' => '1;2;3',
                'due_date' => '2017-05-03'
            ]
        );
        DB::table('projects')->insert(
            [
                'name' => 'DO AN Tot nghiep',
                'type' => 'university project',
                'description' => 'chìa khóa ra trường, làm gì h',
                'account_id' => 2,
                'participants' => '1;2;3;4',
                'due_date' => '2018-05-03'
            ]
        );

        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'participants' => '1;2;3',
                'due_date' => '2018-05-03',
                'project_id' => 1,
                'status' => 'doing',
                'description' => 'làm đồ án phần backend'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'participants' => '1',
                'due_date' => '2018-05-03',
                'project_id' => 1,
                'status' => 'doing',
                'description' => 'chơi'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '2',
                'participants' => '1;2',
                'due_date' => '2019-05-03',
                'project_id' => 2,
                'status' => 'done',
                'description' => 'học bài'
            ]
        );

        DB::table('comments')->insert(
            [
                'account_id' => 1,
                //'type' => 'text',
                'content' => 'lam ngu vcl, dap hết đi làm lại đê',
                'task_id' => 1,
            ]
        );
        DB::table('comments')->insert(
            [
                'account_id' => 2,
                //'type' => 'text',
                'content' => 'ok để em làm lại ',
                'task_id' => 1,
            ]
        );
        DB::table('comments')->insert(
            [
                'account_id' => 2,
                //'type' => 'text',
                'content' => 'tóc đẹp không',
                'task_id' => 2,
            ]
        );
        DB::table('comments')->insert(
            [
                'account_id' => 1,
                //'type' => 'text',
                'content' => 'đầu tóc như cái lông chồn',
                'task_id' => 2,
            ]
        );

        // project_participants

        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 1
            ]
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 2
            ]
        );
        // DB::table('project_participants')->insert(
        //     [
        //         'project_id' => 1,
        //         'account_id' => 3
        //     ]
        // );
        // DB::table('project_participants')->insert(
        //     [
        //         'project_id' => 2,
        //         'account_id' => 1
        //     ]
        // );

        /////

        DB::table('task_participants')->insert(
            [
                'task_id' => 1,
                'account_id' => 1
            ]
        );
        DB::table('task_participants')->insert(
            [
                'task_id' => 1,
                'account_id' => 2
            ]
        );
        // DB::table('task_participants')->insert(
        //     [
        //         'task_id' => 2,
        //         'account_id' => 1
        //     ]
        // );
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
