<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('task_id');
            $table->bigInteger('account_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('project_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('project_id');
            $table->bigInteger('account_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 1
            ],
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 2
            ],
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 1,
                'account_id' => 3
            ],
        );
        DB::table('project_participants')->insert(
            [
                'project_id' => 2,
                'account_id' => 1
            ],
        );
        /////
        DB::table('task_participants')->insert(
            [
                'task_id' => 1,
                'account_id' => 1
            ],
        );
        DB::table('task_participants')->insert(
            [
                'task_id' => 1,
                'account_id' => 2
            ],
        );
        DB::table('task_participants')->insert(
            [
                'task_id' => 2,
                'account_id' => 1
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
        Schema::dropIfExists('task_participants');
        Schema::dropIfExists('project_participants');
    }
}
