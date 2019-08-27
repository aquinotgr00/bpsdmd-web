<?php

use App\Services\Application\AuthService;

if (!function_exists("check_authorization")) {
	function check_authorization($role = null)
	{
		$userAccess = new AuthService();
		$currentUser = $userAccess->check();

		if ($currentUser && $currentUser['authority'] == $role) {
			return true;
		}

		return false;
	}
}

if (!function_exists("get_user_data")) {
	function get_user_data()
	{
		$userAccess = new AuthService();
		$currentUser = $userAccess->user();
		if ($currentUser) {
			return $currentUser;
		}

		return false;
	}
}
