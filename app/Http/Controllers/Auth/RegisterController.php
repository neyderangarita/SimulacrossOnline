<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    public function showRegistrationForm()
    {
        return view('adminlte::auth.register');
        //return view('auth.register');
    }
    */

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/respuesta';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     //Funcion que genera el codigo //
    function generarCodigo($longitud) {
          $key = '';
          $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
          $max = strlen($pattern)-1;
          for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
          return $key;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            //'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $code = $this->generarCodigo(6);

        $fields = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'code'     => $code,
        ];

        /*
        if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
            $fields['username'] = $data['username'];
        }
        */
        return User::create($fields);
    }
}
