<?php

class User extends Model
{
    public $table = 'users';
	const COUNT_MESSAGES_ON_PAGE = 5;

    public function save($login, $email, $pass)
    {
        $pass = md5(md5($pass).md5($login).SALT);
        $sql = "INSERT INTO users VALUES(null, ?, ?, ?, 'user')";
        return $this->query($sql, [$login, $email, $pass]);
    }
	
	public function getMessagesByLogin($loginId, $page)
	{
		$page = ($page != 0) ? $page : 1;
		$sql = 'SELECT n.title, c.date, c.message 
				FROM comments c LEFT JOIN news n ON c.news_id = n.id WHERE user_id = ? AND active = 1 
				ORDER BY date DESC
				LIMIT '.self::COUNT_MESSAGES_ON_PAGE.' OFFSET '.($page - 1) * self::COUNT_MESSAGES_ON_PAGE;
		return $this->findBySql($sql, [$loginId]);
	}
	
	public function getTotalMessages($loginId)
	{
		$sql = 'SELECT COUNT(id) as count FROM comments WHERE user_id = ? AND active = 1';
		return $this->findBySql($sql, [$loginId])[0]['count'];
	}

    public function checkLogin($login)
    {
        return (preg_match('/^[a-z0-9_\."\'&]{3,32}$/ui', $login));
    }

    public function checkPassword($pass)
    {
        return (mb_strlen($pass) > 6);
    }

    public function checkEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public function emailExists($email)
    {
        return ($this->findOne($email, 'email')) ? true : false;
    }

    public function loginExists($login)
    {
        return ($this->findOne($login, 'login')) ? true : false;
    }
	
	public function auth($id)
    {
        $_SESSION['user'] = $id;
    }
	
    public function checkUserData($login, $pass)
    {
		$pass = md5(md5($pass).md5($login).SALT);
        $sql = 'SELECT id FROM users WHERE login = ? AND password = ?';
		$result = $this->findBySql($sql, [$login, $pass]);
		
        return ($result) ? $result[0]['id']: false;
    }
	
	public function checkLogged()
	{
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
		
		header('Location: /login');
	}
	
	public function getUserById($id)
	{
       $sql = 'SELECT role FROM users WHERE id = ?';
	   
	   return $this->findBySql($sql, [$id]);
	}
}