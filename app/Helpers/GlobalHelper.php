<?php

use App\Services\Application\AuthService;

function check_authorization($role = null)
{
    $userAccess = new AuthService();
    $currentUser = $userAccess->check();

    if ($currentUser && $currentUser['authority'] == $role) {
        return true;
    }

    return false;
}
