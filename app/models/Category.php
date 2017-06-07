<?php

class Category extends Model
{
	protected $table = 'categories';
	
	public function getCategoriesAdmin()
	{
		$sql = 'SELECT * FROM categories';
		return $this->findAll();
	}
	
	public function add($name, $alias)
	{
		$sql = 'INSERT INTO categories VALUES(null, ?, ?, NOW(), NOW())';
		return $this->query($sql, [$name, $alias]);
	}
	
	public function getCategoryById($id)
	{
		$sql = 'SELECT name, alias FROM categories WHERE id = ?';
		return $this->findBySql($sql, [$id]);
	}
	
	public function edit($name, $alias, $id)
	{
		$sql = 'UPDATE categories SET name = ?, alias = ?, updated_at = NOW() WHERE id = ?';
		return $this->query($sql, [$name, $alias, $id]);
	}
	
	public function delete($id)
	{
		$sql = 'DELETE FROM categories WHERE id = ?';
		return $this->query($sql, [$id]);
	}
}