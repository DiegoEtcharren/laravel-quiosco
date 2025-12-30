<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistroRequest $request) {
        // Validar registro:
        $data = $request->validated();

        // Crear usuario:
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email' => bcrypt($data['password'])
        ]);

        // Retornar respuesta:
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(Request $register) {}

    public function logout(Request $register) {}
}
