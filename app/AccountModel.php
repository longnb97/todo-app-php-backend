<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Tymon\JWTAuth\Contracts\JWTSubject;

class AccountModel extends Model implements JWTSubject
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
