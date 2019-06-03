<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TaskParticipantsModel extends Model implements JWTSubject
{
    public static function _createTaskParticipants($TaskParticipants)
    {
        return DB::table('task_participants')->insert($TaskParticipants);
    }

    public static function _getAllTaskParticipants()
    {
        return DB::table('task_participants')->get();
    }
}
