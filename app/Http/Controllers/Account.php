<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AccountsModel;

// use App\Helpers;

class Account extends Controller
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

    public function login(Request $request)
    {
        // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $out->writeln($request->password);

        if (!empty($request->email) && !empty($request->password)) {
            //đủ mk + tk
            $data = DB::table('accounts')
                ->where('email', '=', $request->email)
                ->first();
            if (empty($data)) {
                // không có tk
                $response = $this->message(0, 'account not found', 404, $data);
                return response()->json($response);
            } else {
                //có tk
                if (Hash::check($request->password, $data->password) == true) {
                    //đúng mk
                    $response = $this->message(1, 'login success', 200, $data);
                    return response()->json($response);
                } else {
                    //sai mk
                    $response = $this->message(0, 'wrong password', 401, null);
                    return response()->json($response);
                }
            }
        } else {
            // thiếu mk hoặc tk
            $response = $this->message(1, 'bad request', 400, null);
        }
        return response()->json($response);
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
