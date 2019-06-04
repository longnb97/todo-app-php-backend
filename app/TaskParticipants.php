<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TaskParticipants extends Model
{
    public static function create($taskParticipants)
    {
        return DB::table('task_participants')->insert($taskParticipants);
    }

    public static function getAll()
    {
        return DB::table('task_participants')->get();
    }

    public static function getByTaskId($taskId)
    {
        // công việc có những người nào thực hiện
        return DB::table('task_participants')->where('task_id', '=', $taskId)->get();
    }

    public static function getByAccountId($accountId)
    {
        // 1 người này thực hiện những công việc nào
        return DB::table('task_participants')->where('account_id', '=', $accountId)->get();
    }
    
}
