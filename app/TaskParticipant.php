<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TaskParticipant extends Model
{
    public static function create($taskParticipant)
    {
        return DB::table('task_participants')->insert($taskParticipant);
    }

    public static function getAll()
    {
        return DB::table('task_participants')
        ->where('active', 1)
        ->get();
    }

    public static function getByTaskId($taskId)
    {
        // công việc có những người nào thực hiện
        return DB::table('task_participants')
        ->where('task_id', '=', $taskId)
        ->where('active', 1)
        ->get();
    }

    public static function getByAccountId($accountId)
    {
        // 1 người này thực hiện những công việc nào
        return DB::table('task_participants')
        ->where('account_id', '=', $accountId)
        ->where('active', '=', 1)
        ->get();
    }

    public static function deleteById($taskId,$accountId)
    {
        return DB::table('task_participants')
        ->where('account_id', $accountId)
        ->where('task_id', $taskId)
        // ->update(['active' => 0]);
        ->delete();
    }
}
