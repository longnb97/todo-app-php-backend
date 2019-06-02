<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectModel extends Model
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
        return DB::table('projects')->where('projectId', '=', $id)->get();
    }

    public static function deleteProject($id)
    {
        return DB::table('projects')->where('projectId', '=', $id)->delete();
    }
    public static function getAccountProjects($userId)
    {
        return DB::table('projects')->where('accountId', '=', $userId)->get();
    }

    public static function changeProperties($project, $id)
    {
        $query = DB::table('projects')->where('projectId', '=', $id)->update($project);
        return $query;
    }
}
