<?php

class Comments extends Model
{
	public function getComments()
	{
		$sql = 'SELECT c.id, message, n.title, u.login, active FROM comments c 
				LEFT JOIN users u ON c.user_id = u.id
				LEFT JOIN news n ON c.news_id = n.id';
		return $this->findBySql($sql);
	}
	
	public function getCommentsForCheck()
	{
		$sql = 'SELECT c.id, message, n.title, u.login, active FROM comments c 
				LEFT JOIN users u ON c.user_id = u.id
				LEFT JOIN news n ON c.news_id = n.id WHERE active = 0';
		return $this->findBySql($sql);
	}
	
		
	public function getCommentById($id)
	{
		$sql = 'SELECT message, active FROM comments WHERE id = ?';
		return $this->findBySql($sql, [$id]);
	}
	
	public function edit($message, $active, $id)
	{
		$sql = 'UPDATE comments SET message = ?, active = ? WHERE id = ?';
		return $this->query($sql, [$message, $active, $id]);
	}
	
	public function delete($id)
	{
		$sql = 'DELETE FROM comments WHERE id = ?';
		return $this->query($sql, [$id]);
	}
}