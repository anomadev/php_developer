<?php

namespace App\Http\Controllers;

use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if (!$user && Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessage([
                'email' => 'El email no existe o no coincide con nuestros datos'
            ]);
        }

        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
