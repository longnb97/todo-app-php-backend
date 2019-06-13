<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ProjectParticipant extends Model implements JWTSubject
{
    public static function createTask($project_participants)
    {
        return DB::table('project_participants')->insert($project_participants);
    }

    public static function getAll()
    {
        return DB::table('project_participants')->get();
    }

    public static function getAccountProjects($accountId)
    {
        // return DB::table('project_participants')
        //     ->where("account_id", "=", $accountId)
        //     ->get();
        return  DB::table('project_participants')
            ->join('projects', 'project_participants.project_id', '=', 'projects.id')
            ->select('projects.*')
            ->distinct()
            ->get();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
