<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Support\Facades\DB;

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
                'email' => $request->get('1'),
                'password' => $request->get('2'),
                // 'token' => 'Bearer aaaa',
                'name' => $request->get('3'),
                'job' => $request->get('4'),
                'company' => $request->get('5'),
            ],
        );
        $response = [
            'created' => 'success',
        ];
        return response()->json($response, 201);
    }
}
