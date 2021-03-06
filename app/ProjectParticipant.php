<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ProjectParticipant extends Model implements JWTSubject
{
    public static function createProjectParticipant($project_participants)
    {
        return DB::table('project_participants')->insert($project_participants);
    }

    public static function getAll()
    {
        return DB::table('project_participants')->get();
    }

    public static function getParticipants($projectId)
    {
        return  DB::table('project_participants')
            ->join('accounts', 'accounts.id', '=', 'project_participants.account_id')
            ->select('accounts.email', 'accounts.name', 'accounts.job', 'accounts.company', 'project_participants.*')
            ->where('project_participants.project_id', '=', $projectId)
            ->get();
    }

    public static function getProjects($accountId)
    {
        return  DB::table('project_participants')
            ->join('projects', 'project_participants.project_id', '=', 'projects.id')
            ->select('projects.*')
            ->where('project_participants.account_id', '=', $accountId)
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
