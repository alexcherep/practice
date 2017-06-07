<?php

class AdminController extends AdminBase
{
	public function index()
	{
		$this->checkAdmin();
	}
	
	public function style()
	{
		$this->checkAdmin();
		
		$file = file_get_contents(ROOT.'/app/views/layouts/default.php');
		preg_match('/nav style="background: ([#0-9a-z]+)"/ui', $file, $nav);
		preg_match('/body style="background: ([#0-9a-z]+)"/ui', $file, $body);
		
		
		if (!empty($_POST['body'])) {
			$temp = str_replace($body[1],$_POST['bodyColor'] , $file);
			file_put_contents(ROOT.'/app/views/layouts/default.php', $temp);
			header('Location: /');
		}
		
		if (!empty($_POST['nav'])) {
			$temp = str_replace($nav[1],$_POST['navColor'] , $file);
			file_put_contents(ROOT.'/app/views/layouts/default.php', $temp);
			header('Location: /');
		}
		
		$this->set(['nav' => $nav[1], 'body' => $body[1]]);
		
	}
}