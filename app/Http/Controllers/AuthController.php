<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Account;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
   
    public function message($success, $message, $statusCode, $data)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'statusCode' => $statusCode
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return $response;
    }

    // public function login(Request $request){
    //     $credentials = request(['email', 'password']);
    //     $token = auth()->attempt($credentials);
    //     return $token;
    //     // {
    //     //     "email": "testpass2",
    //     //     "password": "2"
    //     // }
    // }
    
    public function handleLogin(Request $request)
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
}
