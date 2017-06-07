<?php

class AdminBase extends Controller
{
	protected $layout = 'admin';
	
	public function checkAdmin()
	{
		$obj = new User();
		$userId = $obj->checkLogged();
		
		$user = $obj->getUserById($userId);
		
		if ($user[0]['role'] == 'Admin') {
			return true;
		}
		
		die('Access denied');
	}
}