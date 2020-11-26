<?php

namespace HelloCash\HelloMicroservice\Providers;


use HelloCash\HelloMicroservice\JwtUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class JwtUserProvider implements UserProvider
{

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }

    public function retrieveByCredentials(array $credentials)
    {
        return new JwtUser();
    }

    public function retrieveById($identifier)
    {
        return new JwtUser();
    }

    public function retrieveByToken($identifier, $token)
    {
        return new JwtUser();
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

}
