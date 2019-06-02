<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use App\Account;

class TestController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['test']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    // public function handleLogin(Request $request)
    // {
    //     // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    //     // $out->writeln($request->password);

    //     if (!empty($request->email) && !empty($request->password)) {
    //         //đủ mk + tk
    //         $data = DB::table('accounts')
    //             ->where('email', '=', $request->email)
    //             ->first();
    //         if (empty($data)) {
    //             // không có tk
    //             $response = $this->message(0, 'account not found', 404, $data);
    //             return response()->json($response);
    //         } else {
    //             //có tk
    //             if (Hash::check($request->password, $data->password) == true) {
    //                 //đúng mk
    //                 $response = $this->message(1, 'login success', 200, $data);
    //                 return response()->json($response);
    //             } else {
    //                 //sai mk
    //                 $response = $this->message(0, 'wrong password', 401, null);
    //                 return response()->json($response);
    //             }
    //         }
    //     } else {
    //         // thiếu mk hoặc tk
    //         $response = $this->message(1, 'bad request', 400, null);
    //     }
    //     return response()->json($response);
    // }
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
