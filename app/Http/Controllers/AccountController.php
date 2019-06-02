<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;



use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Account as AccountModel;

use Illuminate\Database\QueryException;

// use App\Helpers;

class AccountController extends Controller
{
    public function message($success, $message, $statusCode, $data = 'none', $err = 'none')
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
            $data = AccountModel::createAccount($user);
            $response = $this->message(1, 'account created', 201, $data);
        } catch (QueryException $ex) {

            $response = $this->message(0, 'error', 500, null, $ex);
        }
        return response()->json($response);
    }

    public function getAllAccounts(Request $request)
    {
        try {
            $data = AccountModel::getAll();
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

    public function getAccountById(Request $request, $id)
    {
        try {
            $data = AccountModel::getById($id);
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
    public function deleteAccountById(Request $request, $id)
    {
        try {
            $data = AccountModel::getById($id);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'account not found', 404, $data);
            } else {
                $deleteQuery = AccountModel::deleteAccount($id);
                $response = $this->message(1, 'deleted', 200);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }

    public function changePassword(Request $request, $id)
    { }
}
