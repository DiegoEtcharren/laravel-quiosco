<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function register(RegistroRequest $request) {
        // Validar registro:
        $data = $request->validated();

        // Crear usuario:
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // Retornar respuesta:
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();
        // Revisar el password:
        if(!Auth::attempt($data)) {
            return response([
                'errors' => ['El email o el password son incorrectos.']
            ], 422);
        }

        // Autenticar:
        $user = Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];


    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null
        ];
    }
}
