<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

use App\Helpers\ResponseService as Client;
use App\Account as AccountModel;
// use App\Helpers;

class AccountController extends Controller
{
    public function createAccount(Request $request)
    {
        $user =  [
            'email' => $request->email, 
            'password' => bcrypt($request->password),// hash password
            'token' => null,
            'name' => $request->name,
            'job' => $request->job,
            'company' => $request->company,
        ];
        // //$token = JWTAuth::($user);
        // //$user['token'] = $token;

        try {
            $data = AccountModel::create($user);
            return Client::response(1, 'account created', 201, $data);
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, null, $ex, 'errmsg');
        }
    }

    public function getAllAccounts(Request $request)
    {
        try {
            $data = AccountModel::getAll();
            if ($data->isEmpty()) {
                return Client::response(0, 'accounts not found', 404, $data);
            } else {
                return Client::response(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, null, $ex);
        }
    }

    public function getAccountById(Request $request, $id)
    {
        try {
            $data = AccountModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'account not found', 404, $data);
            } else {
                return Client::response(1, 'account found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function deleteAccountById(Request $request, $id)
    {
        try {
            $data = AccountModel::getById($id);
            if ($data->isEmpty()) {
                 return Client::response(0, 'account not found', 404, $data);
            } else {
                $deleteQuery = AccountModel::deleteAccount($id);
                return Client::response(1, 'deleted', 200);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function changePassword(Request $request, $id)
    { }
}
