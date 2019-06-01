<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Account extends Controller
{
    public function login(Request $request)
    {
        $response = [
            'aaa' => true,
            'bbb' => 'bảo Long',
            'dd' => 2,
        ];
        return response()->json($response, 200);
    }

    public function createAccount(Request $request)
    {
        DB::table('accounts')->insert(
            [

                'email' => $request->email,
                'password' => bcrypt($request->password),
                'token' => $request->token,
                'name' => $request->name,
                'job' => $request->job,
                'company' => $request->company,
            ],
        );
        $response = [
            'created' => 'success',
        ];
        return response()->json($response, 201);
    }

    public function getAccount(Request $request)
    {
        $data = DB::table('accounts')->get();
        $response = [
            'created' => 'success',
            'data' => $data
        ];
        return response()->json($response, 201);
    }

    public function getAccountById($id)
    {
        $data = DB::table('accounts')
            ->where('accountId', '=', $id)
            ->get();
        $response = [
            'created' => 'success',
            'data' => $data
        ];
        return response()->json($response, 201);
    }
}
