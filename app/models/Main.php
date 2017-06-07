<?php

class Main extends Model
{
    public $table = 'news';
	
	public function getTopUserByComments()
	{
		$sql = 'SELECT u.login, u.id, COUNT(c.id) as `count` FROM comments c LEFT JOIN users u ON c.user_id = u.id GROUP BY c.user_id ORDER BY count DESC LIMIT 5';
		
		return $this->findBySql($sql);
	}
	
	public function getTopNewsToday()
	{
		$sql = 'SELECT COUNT(c.id) as count, n.title, n.alias, cat.alias as category FROM comments c LEFT JOIN news n ON c.news_id = n.id LEFT JOIN categories cat ON n.category_id = cat.id WHERE `date` > NOW() - INTERVAL 1 DAY GROUP BY news_id ORDER BY count DESC LIMIT 3';
		
		return $this->findBySql($sql);
	}
}