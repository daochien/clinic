<?php

namespace App\Services;

class RolesServices
{
	/**
	 * Return the array of roles in the format
	 *
	 * [
	 * 	 1 => 'Role Name',
	 * ]
	 * @return array
	 */
    public function __invoke() : array
    {
    	return [
    		1 => 'Admin',
    	];
    }
}
