<?php

namespace App\Http\Controllers;



class UserController extends Controller
{

    /**
     * Exibe a página de login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Exibe a página de registro
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Exibe o modal de adicionar usuários
     */
    public function addUsers()
    {
        return view('users.add_users');
    }

}
