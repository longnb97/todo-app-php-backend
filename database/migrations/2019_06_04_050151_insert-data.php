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
                'email' => 'long@gmail.com',
                'password' => Hash::make('1'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Bảo Long',
                'job' => 'Student',
                'company' => 'Pal'
            ]
        );
        DB::table('accounts')->insert(
            [
                'email' => 'quan@gmail.com',
                'password' => Hash::make('2'),
                // 'token' => 'Bearer aaaa',
                'name' => 'Nguyễn Tiến Quân',
                'job' => 'Lao công',
                'company' => 'đời'
            ]
        );

        DB::table('accounts')->insert(
            [
                'email' => 'tongthang@gmail.com',
                'password' => Hash::make('3'),
                'name' => 'Nguyễn Tiến Thắng pass 3',
                'job' => 'thất nghiệp',
                'company' => 'không có'
            ]
        );
        // check
        DB::table('accounts')->insert(
            [
                'email' => 'tuananh@gmail.com',
                'password' => Hash::make('4'),
                'name' => 'Nguyễn Tiến Anh',
                'job' => 'Vô dụng',
                'company' => 'anonymous'
            ]
        );
        DB::table('projects')->insert(
            [
                'name' => 'Đồ án PHP',
                'type' => 'homework',
                'description' => 'Cố gắng kiếm con A',
                'account_id' => 1,
                'due_date' => '2019-06-15'
            ]
        );
        DB::table('projects')->insert(
            [
                'name' => 'Đồ án tốt nghiệp',
                'type' => 'homework',
                'description' => 'chìa khóa ra trường, làm gì giờ',
                'account_id' => 1,
                'due_date' => '2020-05-03'
            ]
        );

        DB::table('projects')->insert(
            [
                'name' => 'BTL của Quân',
                'type' => 'university project',
                'description' => 'nát',
                'account_id' => 2,
                'due_date' => '2019-05-03'
            ]
        );


        DB::table('projects')->insert(
            [
                'name' => 'Web bán hàng',
                'type' => 'university project',
                'description' => 'shopee pi pi pi pi',
                'account_id' => 3,
                'due_date' => '2018-05-03'
            ]
        );

        DB::table('projects')->insert(
            [
                'name' => 'Đồ án của Quân',
                'type' => 'university project',
                'description' => 'nát luôn',
                'account_id' => 2,
                'due_date' => '2018-05-03'
            ]
        );



        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'due_date' => '2019-05-03',
                'project_id' => 1,
                'status' => 'doing',
                'description' => 'làm đồ án phần backend',
                'image' => 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'due_date' => '2019-05-13',
                'project_id' => 1,
                'status' => 'doing',
                'description' => 'chơi'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '1',
                'due_date' => '2019-05-03',
                'project_id' => 2,
                'status' => 'done',
                'description' => 'học bài',
                'image' => 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '2',
                'due_date' => '2019-05-03',
                'project_id' => 1,
                'status' => 'done',
                'description' => 'học bài',
                'image' => 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );
        DB::table('tasks')->insert(
            [
                'owner' => '2',
                'due_date' => '2019-05-03',
                'project_id' => 2,
                'status' => 'done',
                'description' => 'học bài',
                'image' => 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
            ]
        );

        DB::table('comments')->insert(
            [
                'account_id' => 1,
                //'type' => 'text',
                'content' => 'lam ngu vc, đập hết đi làm lại đê',
                'task_id' => 1,
            ]
        );
        DB::table('comments')->insert(
            [
                'account_id' => 2,
                //'type' => 'text',
                'content' => 'ok để em làm lại a ơi',
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
                'content' => 'đầu tóc như cái lông chổi',
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
        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 3
            ]
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 2,
                'account_id' => 1
            ]
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 2,
                'account_id' => 2
            ]
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 2,
                'account_id' => 3
            ]
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 3,
                'account_id' => 1
            ]
        );

        DB::table('project_participants')->insert(
            [
                'project_id' => 3,
                'account_id' => 2
            ]
        );

        DB::table('project_participants')->insert(
            [
                'project_id' => 5,
                'account_id' => 2
            ]
        );

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
        DB::table('task_participants')->insert(
            [
                'task_id' => 2,
                'account_id' => 1
            ]
        );
        
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
