<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectParticipant extends Model
{
    public static function createTask($project_participants)
    {
        return DB::table('project_participants')->insert($task);
    }

    public static function getAll()
    {
        return DB::table('project_participants')->get();
    }
}
