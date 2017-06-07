<?php

class Comment
{
	protected $table, $user, $news, $active, $obj;
		
	public function __construct($table, $newsId, $active)
	{
		$this->obj = new Model();
		$this->table = $table;
		$this->user = ($this->checkAuth()) ? $_SESSION['user'] : null;
		$this->news = $newsId;
		$this->active = $active;
	}
		
    public function getForm()
    {
        $html = '';
        if ($this->checkAuth()) {
            $html = '<form method="post" action="">
                         <textarea name="message" class="form-control" rows="3" placeholder="Оставьте комментарий..."></textarea>   
                         <input type="submit" value="Отправить" name="comment">
                     </form>
                    ';
        } else {
            $html = '<div><b>Незарегистрированные пользователи не могут оставлять комментарии</b></div>';
        }

        return $html;
    }
	
	public function getComments($newsId)
    {
        $sql = "SELECT c.message, u.login, u.id, DATE_FORMAT(c.date, '%d/%m/%Y %H:%i') as `date`, UNIX_TIMESTAMP(c.date) as  `timestamp`, c.rating, c.id as commentId 
				FROM comments c LEFT JOIN users u ON c.user_id = u.id 
				WHERE news_id = ? AND active = 1 ORDER BY c.rating DESC";
		
		return $this->obj->findBySql($sql, [$newsId]);
    }

    public function checkAuth()
    {
        return (isset($_SESSION['user']));
    }
	
	public function checkForm($message)
    {
        $msg = nl2br(htmlspecialchars(trim($message)));
		
		if (!$msg) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		} 
			
		return $msg;
    }
	
	public function canEdit($writer, $date)
	{
		$time = time() - $date;
		if (isset($_SESSION['user']) and ($writer == $_SESSION['user']) and $time <= 60) {
			return ' | <a href="#">Редактировать</a>';
		}
	}
	
	public function addRating($commentId, $userId)
	{
		$sql = 'INSERT INTO ratings VALUES(null, ?, ?)';
		$this->obj->query($sql, [$userId, $commentId]);
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	public function checkAcces($commentId)
	{
		if (isset($_SESSION['user'])) {
			$sql = 'SELECT id FROM ratings WHERE comment_id = ? AND user_id = ?';
			return $this->obj->findBySql($sql, [$commentId, $_SESSION['user']]) ? false : true;
		}
		
		return false;
	}
	
	public function plusRating($id, $user)
	{
		$sql = 'UPDATE comments SET rating = rating + 1 WHERE id = ?';
		$this->obj->query($sql, [$id]);
		$this->addRating($id, $user);
	}
	
	public function minusRating($id, $user)
	{
		$sql = 'UPDATE comments SET rating = rating - 1 WHERE id = ?';
		$this->obj->query($sql, [$id]);
		$this->addRating($id, $user);		
	}
	
	public function save($message)
    {
		$msg = $this->checkForm($message);
		
        $sql = "INSERT INTO {$this->table}
				VALUES(null, ?, ?, ?, NOW(), ?, 0)";
				
		$this->obj->query($sql, [$message, $this->news, $this->user, $this->active]);
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}