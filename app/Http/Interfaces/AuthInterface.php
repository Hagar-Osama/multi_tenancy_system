<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface AuthInterface {

    public function register($request);

    public function createNewToken($token);

    public function login($request);

    public function logout();




}
