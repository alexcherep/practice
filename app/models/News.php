<?php

class News extends Model
{
    public $table = 'news';
    const COUNT_NEWS_ON_PAGE = 5;


    public function getNewsByCategory($categoryID, $page = 1)
    {
        $page = ($page != 0) ? $page : 1;
        if ($categoryID == 'analytics') {
            $sql = 'SELECT n.title, n.alias, DATE_FORMAT(n.created_at, "%H:%i") as `date`, c.alias as category 
                    FROM news n LEFT JOIN categories c ON n.category_id = c.id 
                    WHERE isAnalytics = 1 ORDER BY n.updated_at 
                    DESC LIMIT '.self::COUNT_NEWS_ON_PAGE.' OFFSET '.($page - 1) * self::COUNT_NEWS_ON_PAGE;
        } else {
            $sql = 'SELECT title, alias, DATE_FORMAT(created_at, "%H:%i") as `date` 
                    FROM news WHERE category_id = (SELECT id FROM categories WHERE alias = ? ) 
                    ORDER BY updated_at DESC 
                    LIMIT '.self::COUNT_NEWS_ON_PAGE.' OFFSET '.($page - 1) * self::COUNT_NEWS_ON_PAGE;
        }

        return $this->findBySql($sql, [$categoryID]);
    }

    public function getNewsByTag($tag, $page = 1)
    {
        $page = ($page != 0) ? $page : 1;
        $sql = 'SELECT n.title, n.alias, DATE_FORMAT(n.created_at, "%H:%i") as `date`, c.alias as category 
                FROM tags2news tn LEFT JOIN news n ON tn.news_id = n.id 
                LEFT JOIN categories c ON n.category_id = c.id 
                WHERE tag_id = (SELECT id FROM tags WHERE alias = ?) 
                ORDER BY n.updated_at DESC 
                LIMIT '.self::COUNT_NEWS_ON_PAGE.' OFFSET '.($page - 1) * self::COUNT_NEWS_ON_PAGE;

        return $this->findBySql($sql, [$tag]);
    }


    public function getTotalNews($categoryID)
    {
        if ($categoryID == 'analytics') {
            $sql = 'SELECT COUNT(id) as `count` 
                    FROM news WHERE isAnalytics = 1';
        } else {
            $sql = 'SELECT COUNT(id) as `count` 
                    FROM news WHERE category_id = (SELECT id FROM categories WHERE alias = ?)';
        }
        
        return $this->findBySql($sql, [$categoryID])[0]['count'];
    }

    public function getTotalNewsByTag($alias)
    {
        $sql = 'SELECT COUNT(id) as `count` FROM tags2news WHERE tag_id = (SELECT id FROM tags WHERE alias = ?)';

        return $this->findBySql($sql, [$alias])[0]['count'];
    }
	
	public function getListNews()
	{
         $sql = 'SELECT n.id, n.title, c.name FROM news n 
				 LEFT JOIN categories c ON n.category_id = c.id';

        return $this->findBySql($sql);
    }

    public function isPolitics($categoryId)
    {
        $sql = 'SELECT id FROM categories WHERE alias = "politics"';
		$result = $this->findBySql($sql);
		
		return ($categoryId == $result[0]['id']) ? 0 : 1;
    }
	
	public function getTags()
	{
		$sql = 'SELECT * FROM tags';
		return $this->findBySql($sql);
	}
	
	public function getNewsById($id)
	{
		$sql = 'SELECT * FROM news WHERE id = ?';
		return $this->findBySql($sql, [$id]);
	}
	
	public function addNews($title, $alias, $text, $category, $analytics)
	{
		$sql = 'INSERT INTO news VALUES(null, ?, ?, "test", ?, ?, ?, NOW(), NOW())';
		return $this->query($sql, [$title, $alias, $text, $category, $analytics]);
	}
	
	public function delete($id)
	{
		$sql = 'DELETE FROM news WHERE id = ?';
		return $this->query($sql, [$id]);
	}
	
	public function edit($name, $alias, $text, $category, $id)
	{
		$sql = 'UPDATE news SET title = ?, alias = ?, text = ?, category_id = ?,  updated_at = NOW() WHERE id = ?';
		return $this->query($sql, [$name, $alias, $text, $category, $id]);
	}
	
	public function addTagsNews($alias, $id)
	{
		$news = $this->findBySql('SELECT id FROM news WHERE alias = ?', [$alias]);
		$sql = 'INSERT INTO tags2news VALUES(null, ?, ?)';
		return $this->query($sql, [$id, $news[0]['id']]);
	}
	
	 public function isAnalytics($text)
    {
        $explode = explode('.', $text);
        return implode('.', array_slice($explode, 0, 5)).'.';
    }
	
	public function getId($alias)
    {
        $arr = explode('-', $alias);
		return $arr[0];
    }
}