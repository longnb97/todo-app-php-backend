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
            $table->bigInteger('task_id');
            $table->bigInteger('account_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('project_participants', function (Blueprint $table) {
            $table->bigInteger('project_id');
            $table->bigInteger('account_id');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
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
