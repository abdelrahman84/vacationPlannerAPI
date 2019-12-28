<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\User;
use App\Manager;
use JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Config;
class ManagerController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    function __construct()
{
    Config::set('jwt.user', App\ManagerController::class);
    Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Manager::class,
        ]]);

 
        
}
    

    public function adminLogin() 
    {
    
        $credentials = request(['email', 'password',]);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'access_token' => $token,
                'user' => auth()->user()
            ],
        ]);
        
    }
    

    public function signupManager(Request $request) {
       
        
        $manager = Manager::create($request->all());
        
        return $this->adminLogin($request);
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
   
    protected function adminRespondWithToken($token)
       {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'manager' => auth()->user()
        ]);

       }
}