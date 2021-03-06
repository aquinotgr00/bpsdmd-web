<?php

use App\Services\Application\AuthService;

if (!function_exists('getAuthority')) {
    /**
     * @return bool|string|null
     */
    function getAuthority() {
        $userAccess = new AuthService();
        $currentUser = $userAccess->user();
        if ($currentUser) {
            return $currentUser->getAuthority();
        }

        return false;
    }
}

if (!function_exists("checkAuthorization")) {
    /**
     * @param null $role
     * @return bool
     */
	function checkAuthorization($role = null) {
		$userAccess = new AuthService();
		$currentUser = $userAccess->check();

		if ($currentUser && $currentUser['authority'] == $role) {
			return true;
		}

		return false;
	}
}

if (!function_exists("currentUser")) {
    /**
     * @return \App\Entities\User|bool
     */
	function currentUser() {
		$userAccess = new AuthService();
		$currentUser = $userAccess->user();
		if ($currentUser) {
			return $currentUser;
		}

		return false;
	}
}

if (!function_exists('buildTree')) {
    /**
     * @param array $elements
     * @param null $parentId
     * @return array
     */
	function buildTree(array $elements, $parentId = null) {
        $branch = [];
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
