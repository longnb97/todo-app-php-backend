<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountsModel extends Model
{
    public static function createAccount($user)
    {
        return DB::table('accounts')->insert($user);
    }

    public static function getAll()
    {
        return DB::table('accounts')->get();
    }

    public static function getById($id)
    {
        return DB::table('accounts')->where('accountId', '=', $id)->get();
    }
}
