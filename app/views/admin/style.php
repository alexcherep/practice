<section>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление стилями</li>
                </ol>
            </div>
            <br/>
            <p>Изменить цвет фона:
			<form method="post" action="">
				<input type="color" name="bodyColor" value="<?=$body?>">
				<input type="submit" name="body" value="Изменить">
			</form>
			</p>
            <p>Изменить цвет шапки: 
			<form method="post" action="">
				<input type="color" name="navColor" value="<?=$nav?>">
				<input type="submit" name="nav" value="Изменить">
			</form>
			</p>
        </div>
    </div>
</section>