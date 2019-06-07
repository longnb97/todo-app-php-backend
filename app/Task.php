<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Task extends Model implements JWTSubject
{
    public static function createTask($task)
    {
        return DB::table('tasks')->insert($task);
    }

    public static function getAll()
    {
        return DB::table('tasks')
            ->get();
    }

    public static function getById($id)
    {
        return DB::table('tasks')
            ->where([
                ['id', '=', $id,],
                ['active', '=', 1]
            ])
            ->get();
            
    }

    public static function deleteTask($id)
    {
        return DB::table('tasks')->where('id', '=', $id)->update(['active' => 0]);
    }
    public static function getProjectTasks($projectId)
    {
        return DB::table('tasks')
            ->where([
                ['project_id', '=', $projectId],
                ['active', '=', 1]
            ])
            ->get();
    }

    public static function changeProperties($task, $id)
    {
        $query = DB::table('tasks')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->update($task);
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
