<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="/public/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="/public/css/style.css">
	
	<script src="/public/js/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	


</head>
<body style="background: #ffffff">
<div class="wrapper">
	<header>
    <nav style="background: #000000" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Project name</a>
		  <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <?php
				if (!isset($_SESSION['user'])):
			?>
            <li><a href="/register">Регистрация</a></li>
            <li><a href="/login">Вход</a></li>
			<?php
				endif;
			?>
          </ul>
        </div>
        <div class="navbar-collapse collapse navbar-right">
            <div class="form-group">
              <input type="text" id="search" class="form-control">
            </div>
        </div>
      </div>
    </nav>
	</header>
	<div class="middle">
		<div class="container">
			<section class="content">
				<?=$content;?>
			</section>
		</div>
		<aside class="left-sidebar">
			<div onmouseover="advOver()" onmouseout="advOut()" class="adv adv-left">
				<div class="adv-top">Часы</div>
				<div id="price">500 грн</div>
				<div class="adv-bottom">My-Watch</div>
			</div>
		</aside>
		<aside class="right-sidebar">
		</aside>
	</div>
	
	<footer>
		<div id="overlay">
			<div class="news-letter">
			<h4>Подписаться на новостную рассылку 	<button class="close" title="Закрыть" onclick="document.getElementById('overlay').style.display='none';"></button></h4>
			<form method="post" action="">
				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="name" placeholder="Имя">
				</div>
				<input type="submit" class="btn btn-default" value="Отправить">
			</form>
			</div>
		</div>&copy; 
	</footer>
</div>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script>
		function advOver() {
			var input = document.getElementById('price');
			var number = parseInt(input.innerHTML);
			var percent = number - (number * 0.1);
			input.style.color = 'red';
			input.style.fontSize = '32px';
			input.innerHTML = percent + ' грн';
			
		}
		
		function advOut() {
			var input = document.getElementById('price');
			var number = parseInt(input.innerHTML)
			var percent = number + (number * 0.1112);
			input.innerHTML = parseInt(percent) + ' грн';
			input.style.fontSize = '20px';
			input.style.color = 'black';
		}
		setTimeout("document.getElementById('overlay').style.display='block'", 15000);
	</script>

</body>
</html>