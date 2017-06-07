<?php

class AdminCommentsController extends AdminBase
{	
	public function index()
	{
		$this->checkAdmin();
		$obj = new Comments();
		
		$commentsList = $obj->getComments();
		
		$this->set(['commentsList' => $commentsList]);
	}
	
	public function check()
	{
		$this->checkAdmin();
		$obj = new Comments();
		
		$commentsList = $obj->getCommentsForCheck();
		
		$this->set(['commentsList' => $commentsList]);
	}
	
	public function edit($id)
	{
		$this->checkAdmin();
		$obj = new Comments();
		
		if (!empty($_POST)) {
			$active = ($_POST['moderate']) ? 1 : 0;
			$obj->edit($_POST['message'], $active, $id);
			header('Location: /admin/comments');
		}
		
		$comments = $obj->getCommentById($id);
		
		if (!$comments) {
			header('Location: /admin/comments');
		}

		$this->set(['comments' => $comments]);
	}
	
	public function delete($id)
	{
		$this->checkAdmin();
		$obj = new Comments();
		
		$obj->delete($id);
		header('Location: /admin/comments');
	}
}