<?php

namespace JS\Services\Identity;

interface IdentityClientInterface
{
    /**
     * Login.
     *
     * @param array $data
     */
    public function login(array $data);
}