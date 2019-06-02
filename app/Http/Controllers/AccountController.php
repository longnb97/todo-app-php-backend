<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AccountsModel;

// use App\Helpers;

class AccountController extends Controller
{
    public function message($success, $message, $statusCode, $data)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'statusCode' => $statusCode
        ];
        if(!empty($data)){
            $response['data'] = $data;
        }
        return $response;
    }

    public function createAccount(Request $request)
    {
        $user =  [
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'token' => null,
            'name' => $request->name,
            'job' => $request->job,
            'company' => $request->company,
        ];
        // //$token = JWTAuth::($user);
        // //$user['token'] = $token;

        $data = AccountsModel::createAccount($user);
        $response = $this->message(1, 'account created', 201, $data);
        return response()->json($response, 201);
    }

    public function getAllAccount(Request $request)
    {
        $data = AccountsModel::getAll();
        $response = $this->message(1, 'account found', 200, $data);
        return response()->json($response, 201);
    }

    public function getAccountById($id)
    {
        $data = AccountsModel::getById($id);
        if (!empty($data)) {
            $response = $this->message(1, 'account found', 200, $data);
        }
        return response()->json($response, 201);
    }
}
