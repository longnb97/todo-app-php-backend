<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AccountsModel;

use Illuminate\Database\QueryException;

// use App\Helpers;

class AccountController extends Controller
{
    public function message($success, $message, $statusCode, $data = null, $err = null)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data,
            'err' => $err
        ];
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

        try {
            $data = AccountsModel::createAccount($user);
            $response = $this->message(1, 'account created', 201, $data);
        } catch (QueryException $ex) {
            $response = $this->message(1, 'account created', 201, null, $ex);
        }

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
