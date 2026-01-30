<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Função de login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //Validação dos dados
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
        // Mensagens para o campo Email
        'email.required' => 'O campo e-mail é obrigatório.',
        'email.email' => 'Introduza um endereço de e-mail válido.',

        // Mensagens para o campo Senha
        'password.required' => 'A senha é obrigatória para entrar.',
    ]);

        //Verificação dos dados
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Os dados inseridos não estão corretos. Verifique o e-mail e a senha.',
        ])->onlyInput('email');
    }

    //Função de registo
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Função de adicionar utilizador (registo) - por defeito o usuário vai ter o papel de "user"
     */
    public function register(Request $request, User $user)
    {
        //Validação dos dados
        $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        // Mensagens para o campo Nome
        'name.required' => 'Por favor, insira o seu nome.',
        'name.max' => 'O nome não pode ter mais de 255 caracteres.',
        // Mensagens para o campo Email
        'email.required' => 'O endereço de e-mail é obrigatório.',
        'email.email' => 'Introduza um e-mail num formato válido.',
        'email.unique' => 'Este e-mail já está a ser utilizado por outra conta.',
        // Mensagens para o campo Senha
        'password.required' => 'A senha é obrigatória.',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        'password.confirmed' => 'A confirmação da senha não coincide.',
    ]);

        //Criação do usuário
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    //Função de logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
