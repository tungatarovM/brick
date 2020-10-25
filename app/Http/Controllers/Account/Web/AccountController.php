<?php

namespace App\Http\Controllers\Account\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Account\Resources\User as UserResource;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function currentUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
