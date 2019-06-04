<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Project extends Model implements JWTSubject
{
    public static function createProject($project)
    {
        return DB::table('projects')->insert($project);
    }

    public static function getAll()
    {
        return DB::table('projects')->get();
    }

    public static function getById($id)
    {
        return DB::table('projects')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->get();
    }

    public static function deleteProject($id)
    {
        return DB::table('projects')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->update(['active' => 0]);
    }
    public static function getAccountProjects($userId)
    {
        return DB::table('projects')
            ->where([
                ['account_id', '=', $userId],
                ['active', '=', 1]
            ])
            ->get();
    }

    public static function changeProperties($project, $id)
    {
        return DB::table('projects')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->update($project);
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
