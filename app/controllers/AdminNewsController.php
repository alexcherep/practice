<?php

class AdminNewsController extends AdminBase
{	
	public function index()
	{
		$this->checkAdmin();
		$obj = new News();
		
		$newsList = $obj->getListNews();
		
		$this->set(['newsList' => $newsList]);
	}
	
	public function create()
	{
		$this->checkAdmin();
		$cat = new Category();
		$obj = new News();
		
		$categoriesList = $cat->getCategoriesAdmin();
		$tagsList = $obj->getTags();
		
		if (!empty($_POST)) {
			$analytics = ($_POST['analytics']) ? 1 : 0;
			$obj->addNews($_POST['name'], $_POST['alias'], $_POST['text'], $_POST['category'], $analytics);
			if ($_POST['tag']) {
				foreach ($_POST['tag'] as $tag) {
					$obj->addTagsNews($_POST['alias'], $tag);
				}
			}
			header('Location: /admin/news');
		}
		
		$this->set(['categoriesList' => $categoriesList, 'tagsList' => $tagsList]);
	}
	
	public function edit($id)
	{
		$this->checkAdmin();
		$obj = new News();
		$cat = new Category();
		
		if (!empty($_POST)) {
			$obj->edit($_POST['name'], $_POST['alias'], $_POST['text'], $_POST['category'], $id);
			header('Location: /admin/news');
		}
		
		$news = $obj->getNewsById($id);
		$categoriesList = $cat->getCategoriesAdmin();
		
		if (!$news) {
			header('Location: /admin/news');
		}

		$this->set(['news' => $news, 'categoriesList' => $categoriesList]);
	}
	
	public function delete($id)
	{
		$this->checkAdmin();
		$obj = new News();
		
		$obj->delete($id);
		header('Location: /admin/news');
	}
}