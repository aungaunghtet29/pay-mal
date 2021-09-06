<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin_user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard("admin_user");
    }
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    protected function authenticated(Request $request, $user)
    {

        $user->login_at = Carbon::now()->toDateTimeString();;
        $user->ip = $request->ip();
        $user->user_agent = $request->server('HTTP_USER_AGENT');

        $user->update();

        return redirect($this-> redirectTo);

    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    public function login(Request $request)
    {

         $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|string|min:6'
      ]);


         if (Auth::guard('admin_user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

        return  $this->sendLoginResponse($request);
      }



        return $this->sendFailedLoginResponse($request);
    }
}
