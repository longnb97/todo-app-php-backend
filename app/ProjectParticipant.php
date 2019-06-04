<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectParticipant extends Model
{
    public static function create($projectParticipant)
    {
        return DB::table('project_participants')->insert($projectParticipant);
    }

    public static function getAll()
    {
        return DB::table('project_participants')
        ->where('active', 1)
        ->get();
    }


    public static function checkAccountInProject($projectId, $accountId){
        return DB::table('project_participants')
        ->where('project_id', $projectId)
        ->where('account_id', $accountId)
        ->get();
    }


    public static function getByProjectId($projectId)
    {
        // công việc có những người nào thực hiện
        return DB::table('project_participants')
        ->where('project_id', '=', $projectId)
        ->where('active', 1)
        ->get();
    }

    public static function getByAccountId($accountId)
    {
        // 1 người này thực hiện những công việc nào
        return DB::table('project_participants')
        ->where('account_id', '=', $accountId)
        ->where('active', '=', 1)
        ->get();
    }

    public static function deleteById($projectId,$accountId)
    {
        return DB::table('project_participants')
        ->where('account_id', $accountId)
        ->where('project_id', $projectId)
        // ->update(['active' => 0]);
        ->delete();
    }
}
