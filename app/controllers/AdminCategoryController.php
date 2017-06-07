<?php

class AdminCategoryController extends AdminBase
{
	public function index()
	{
		$this->checkAdmin();
		$obj = new Category();
		
		$categoriesList = $obj->getCategoriesAdmin();
		
		$this->set(['categoriesList' => $categoriesList]);
	}
	
	public function create()
	{
		$this->checkAdmin();
		$obj = new Category();
		
		if (!empty($_POST)) {
			$obj->add($_POST['name'], $_POST['alias']);
			header('Location: /admin/category');
		}
	}
	
	public function edit($id)
	{
		$this->checkAdmin();
		$obj = new Category();
		
		if (!empty($_POST)) {
			$obj->edit($_POST['name'], $_POST['alias'], $id);
			header('Location: /admin/category');
		}
		
		$category = $obj->getCategoryById($id);
		if (!$category) {
			header('Location: /admin/category');
		}

		$this->set(['category' => $category]);
	}
	
	public function delete($id)
	{
		$this->checkAdmin();
		$obj = new Category();
		
		$obj->delete($id);
		header('Location: /admin/category');
	}
}