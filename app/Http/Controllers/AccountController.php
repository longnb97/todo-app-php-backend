<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AccountModel;

use Illuminate\Database\QueryException;

// use App\Helpers;

class AccountController extends Controller
{
    public function message($success, $message, $statusCode, $data = null, $err = 'none')
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

            $response = $this->message(0, 'error', 500, null, $ex);
        }
        return response()->json($response);
    }

    public function getAllAccount(Request $request)
    {
        try {
            $data = AccountsModel::getAll();
            if ($data->isEmpty()) {
                $response = $this->message(0, 'accounts not found', 404, $data);
            } else {
                $response = $this->message(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, null, $ex);
        }
        return response()->json($response);
    }

    public function getAccountById($id)
    {
        try {
            $data = AccountsModel::getById($id);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'account not found', 404, $data);
            } else {
                $response = $this->message(1, 'account found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }
}
