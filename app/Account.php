<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Account extends Authenticatable implements JWTSubject
{
    use Notifiable;

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
        return DB::table('accounts')->where('id', '=', $id)->get();
    }

    public static function deleteAccount($id)
    {
        return DB::table('accounts')->where('id', '=', $id)->delete();
    }

    public static function changePassword($id, $newPassword)
    {
        $newPass = Hash::make($newPassword);
        $query = DB::table('accounts')->where(['id', '=', $id])->update(['password' => $newPass]);
        return  query;
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
