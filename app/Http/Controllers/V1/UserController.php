<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request){

        $user = New User();

        $user->name = $request->data->name;

        // check if email already exists



        $user->name = $request->data->email;
        // needs to be encrypted
        //$user->password = $request->data->password;

    }
}
