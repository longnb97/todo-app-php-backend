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
        return DB::table('projects')->where('id', '=', $id)->get();
    }

    public static function deleteProject($id)
    {
        return DB::table('projects')->where('id', '=', $id)->delete();
    }
    public static function getAccountProjects($userId)
    {
        return DB::table('projects')->where('accountId', '=', $userId)->get();
    }

    public static function changeProperties($project, $id)
    {
        $query = DB::table('projects')->where('id', '=', $id)->update($project);
        return $query;
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
