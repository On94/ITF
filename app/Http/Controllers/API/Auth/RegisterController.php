<?php

namespace App\Http\Controllers\API\Auth;

use App\Facades\UserServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\SingUpRequest;


class RegisterController extends Controller
{
   public function signUp(SingUpRequest $request)
   {
      return UserServiceFacade::create($request->validated());
   }
}
