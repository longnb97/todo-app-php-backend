<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Comment extends Model
{
    public static function createComment($comment)
    {
        return DB::table('comments')->insert($comment);
    }

    public static function getAll()
    {
        return DB::table('comments')->get();
    }

    public static function getById($id)
    {
        return DB::table('comments')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->get();
    }

    public static function deleteComment($id)
    {
        return DB::table('comments')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->update(['active' => 0]);
    }
    public static function getAccountComments($userId)
    {
        return DB::table('comments')
            ->where([
                ['account_id', '=', $userId],
                ['active', '=', 1]
            ])
            ->get();
    }
    public static function getTaskComments($taskId)
    {
        return DB::table('comments')
            ->join('accounts', 'accounts.id', '=', 'comments.account_id')
            ->select('accounts.email', 'accounts.name', 'accounts.job', 'accounts.company', 'comments.*')
            ->where([
                ['comments.task_id', '=', $taskId],
                ['comments.active', '=', 1]
            ])
            ->get();
    }


    public static function changeComment($commentId, $id)
    {
        return DB::table('comments')
            ->where([
                ['id', '=', $id],
                ['active', '=', 1]
            ])
            ->update($commentId);
    }
}
