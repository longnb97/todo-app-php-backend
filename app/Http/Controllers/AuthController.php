<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use PHPUnit\Util\Type;

use App\Helpers\ResponseService;

// use App\Account;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() 
    {
        //$this->middleware('auth:api', ['except' => ['/auth/test']]);
    }

    //NEVER EXPIRE TOKEN eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE1NTk1NDQ0NDUsImV4cCI6MTU2MzE0NDQ0NSwibmJmIjoxNTU5NTQ0NDQ1LCJqdGkiOiJWWmNGUjd1eHVoMmJoSU5MIiwic3ViIjoxLCJwcnYiOiJiNmY3ZjQ3YWNiZjFhNWVlMTFiMmIwMjhkYzU2YWEzNWYyMGMxYTdlIn0.FUwLiAewaoGxyKBo9dfaS7M_fmUpd6aWGOQhKDV0VqA

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    private function getToken($email, $password)
    {
        $token = null;
        try {
            if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Password or email is invalid',
                    'token' => $token
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }

    // public function loginTest(Request $req)
    // {

    //     $user = DB::table('accounts')
    //         ->where('email', '=', $req->email)
    //         ->first();

    //     if ($user && Hash::check($req->password, $user->password)) {
    //         $token = self::getToken($req->email, $req->password);
    //         $user->auth_token = $token;
    //         $user->save();

    //         $response = ['success' => true, 'data' => ['id' => $user->id, 'auth_token' => $user->auth_token, 'name' => $user->name, 'email' => $user->email]];
    //     } else
    //         $response = ['success' => false, 'data' => 'Record doesnt exists'];

    //     return response()->json($response, 201);
    // }

    public function handleLogin(Request $req)
    {
        if (!empty($req->email) && !empty($req->password)) {
            //đủ mk + tk
            $data = DB::table('accounts')
                ->where('email', '=', $req->email)
                ->first();
            if (empty($data)) {
                // không có tk
                return ResponseService::response(0, 'account not found', 404, $data);
            } else {
                //có tk
                if (Hash::check($req->password, $data->password) == true) {
                    //đúng mk
                    $credentials = ['email' => $data->email, 'password' => $data->password];
                    $token = self::getToken($req->email, $req->password);
                    if (gettype($token) != 'string') {
                        //tạo token lỗi
                        return ResponseService::response(0, 'failed to generate token', 500);
                    } else {
                        //tạo token thành công >>> đăng nhập thành công
                        $data->access_token = $token;
                        return ResponseService::response(1, 'login success', 200, $data);
                    }
                } else {
                    //sai mk
                    return ResponseService::response(0, 'wrong password', 401, null);
                }
            }
        } else {
            // thiếu mk hoặc tk
            return ResponseService::response(1, 'bad request', 400, null, 'email/password not recieved', 'errmsg');
        }
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
