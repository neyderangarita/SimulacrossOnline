<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;


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

    /*
    public function showRegistrationForm()
    {
        return view('adminlte::auth.register');
        //return view('auth.register');
    }
    */

    protected $redirectTo = '/respuesta';

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

    protected function create(array $data)
    {   

        $code = $this->generarCodigo(6);
        $email = $data['email'];
        $dates = array('name'=> $data['name'],'code' => $code);
        $this->Email($dates,$email);

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

    function Email($dates,$email){

      Mail::send('emails.plantilla',$dates, function($message) use ($email){
        $message->subject('Bienvenido a la plataforma');
        $message->to($email);
        $message->from('no-repply@simulacrosonline.com.co','SimulacrosOnline');
      });

    }


}
