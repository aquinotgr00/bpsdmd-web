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
if (!function_exists('buildTree')) {
	function buildTree(array $elements, $parentId = null) {
        $branch = array();
        foreach ($elements as $element) {
        	$element['parent_id'] = $element['parent_id'] == 'NULL' ? NULL : $element['parent_id'] ; 
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}
