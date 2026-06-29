<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'tipo' => 'nullable|in:lectura,escritura'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'mensaje' => 'Credenciales incorrectas'
            ], 401);
        }

        // Eliminar tokens anteriores
        $user->tokens()->delete();

        // Determinar permisos
        $abilities = $request->tipo === 'lectura'
            ? ['ver']
            : ['ver', 'crear', 'editar', 'eliminar'];

        $token = $user->createToken('api-token', $abilities)->plainTextToken;

        return response()->json([
            'usuario' => $user,
            'abilities' => $abilities,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'mensaje' => 'Sesión cerrada'
        ]);
    }

    public function perfil(Request $request)
    {
        return response()->json($request->user());
    }
}