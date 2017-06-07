<h2>Вход на сайт</h2>
<?php
if (isset($errors) && $errors) {
    foreach ($errors as $text) {
        echo $text.'<br>';
    }
}
?>
<form method="post" action="">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" name="login" id="login">
    </div>
    <div class="form-group">
        <label for="pass">Пароль</label>
        <input type="password" class="form-control" name="pass" id="pass">
    </div>
    <input type="submit" class="btn btn-default" value="Вход">
</form>