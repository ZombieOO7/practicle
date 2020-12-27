<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\SignupFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserLoginController extends BaseController
{
    public $view = 'user.';
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * -------------------------------------------------------------
     * | view login form                                           |
     * |                                                           |
     * | @return View                                              |
     * -------------------------------------------------------------
     */
    public function loginForm(){
        return view($this->view.'login');
    }

    /**
     * -------------------------------------------------------------
     * | view register form                                        |
     * |                                                           |
     * | @return View                                              |
     * -------------------------------------------------------------
     */
    public function registerForm(){
        return view($this->view.'register');
    }

    /**
     * -------------------------------------------------------------
     * | authenticate user login                                   |
     * |                                                           |
     * | @return View                                              |
     * -------------------------------------------------------------
     */
    public function login(LoginFormRequest $request){
        if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password])) {
            return Redirect::route('user.index')->with(['success'=>'Login Successfully.']);
        }
        return Redirect::back()->with(['error'=>'These credentials does not match with our records.']);
    }

    /**
     * -------------------------------------------------------------
     * | authenticate user login                                   |
     * |                                                           |
     * | @return View                                              |
     * -------------------------------------------------------------
     */
    public function logout(Request $request){
        if(Auth::user()!=null){
            Auth::logout();
            session()->flush();
        }
        return Redirect::route('login')->with(['success'=>'Logout Successfully']);
    }

    /**
     * -------------------------------------------------------------
     * | Register user                                             |
     * |                                                           |
     * | @return View                                              |
     * -------------------------------------------------------------
     */
    public function register(SignupFormRequest $request){
        $this->dbStart();
        try{
            $this->user::create($request->all());
            $this->dbEnd();
            if (Auth::attempt(['email' => strtolower($request->email), 'password' => $request->password])) {
                $msg = __('formname.register_success');
                return Redirect::route('user.index')->with(['message'=>'Registration Completed']);
            }
        }catch(Exception $e){
            $this->dbRollBack();
            return Redirect::back()->with(['error'=> $e->getMessage()]);
        }
    }
}
