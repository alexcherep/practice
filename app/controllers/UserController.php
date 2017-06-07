<?php

class UserController extends Controller
{
	public function index($id, $page = 1)
	{
		$obj = new User();
		$messages = $obj->getMessagesByLogin($id, $page);
		$countMessages = $obj->getTotalMessages($id);
		
		$pagination = new Pagination($countMessages, $page, $obj::COUNT_MESSAGES_ON_PAGE, 'page-');
		
		$this->set(['messages' => $messages, 'pagination' => $pagination]);
	}
	
    public function register()
    {
        $obj = new User();
        $errors = false;
		
        if (!empty($_POST)) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];


            if (!$obj->checkLogin($login)) {
                $errors[] = 'Неккоректно введен логин!';
            }

            if (!$obj->checkPassword($pass)) {
                $errors[] = 'Пароль должен иметь больше 6-и символов';
            }

            if (!$obj->checkEmail($email)) {
                $errors[] = 'Неккоректно введен email!';
            }

            if (!$errors) {
                $errors[] = $obj->loginExists($login) ? 'Пользователь с таким логином уже существует' : ($obj->emailExists($email) ? 'Указанный email уже используется' : false);

                if (!$errors[0]) {
                    $obj->save($login, $email, $pass);
                    exit(header('Location: /'));
                }
            }


        }

        $this->set(['errors' => $errors]);
    }

    public function login()
    {
		$obj = new User();
		$errors = false;
		
		if (!empty($_POST)) {
			$login = $_POST['login'];
            $pass = $_POST['pass'];
			
			if (!$obj->checkLogin($login)) {
                $errors[] = 'Неккоректно введен логин!';
            }

            if (!$obj->checkPassword($pass)) {
                $errors[] = 'Пароль должен иметь больше 6-и символов';
            }
			
			if (!$errors) {
				$userId = $obj->checkUserData($login, $pass);
				
				if (!$userId) {
					$errors[] = 'Неверно введен логин или пароль';
				} else {
					$obj->auth($userId);
					header('Location: /');
				}
            }
        }
		$this->set(['errors' => $errors]);
    }
}