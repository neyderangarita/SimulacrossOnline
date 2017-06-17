<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function activate($code)
    {
        $users = User::where('code', $code);
        $exist = $users->count();
        $user = $users->first();

        if($exist == 1 && $user->active ==0)
        {
            $id = $user->id;
            return view('auth.date_complete', compact('id'));
        }
        else
        {
            return redirect::to('/');
        }
    }

    public function complete(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->estado = 1;
        $user->save();
        return redirect::to('/login');
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
