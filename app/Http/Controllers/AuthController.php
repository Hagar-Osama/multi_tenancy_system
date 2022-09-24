<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\AddAuthRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $AuthInterface;

    public function __construct(AuthInterface $AuthInterface)
    {
        $this->AuthInterface = $AuthInterface;

    }


    public function register(AddAuthRequest $request)
    {
        return $this->AuthInterface->register($request);
    }

    public function createNewToken($token)
    {
        return $this->AuthInterface->createNewToken($token);
    }


    public function login(LoginRequest $request)
    {
        return $this->AuthInterface->login($request);
    }

    public function logout()
    {
        return $this->AuthInterface->logout();

    }







}
