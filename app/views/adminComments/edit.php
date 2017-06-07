<section>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление комментариями</a></li>
                    <li class="active">Редактировать комментарий</li>
                </ol>
            </div>


            <h4>Редактировать комментарий</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                   <form method="post" action="">
						<div class="form-group">
							<label for="message">Сообщение</label>
							<textarea class="form-control" name="message" id="message"><?=$comments[0]['message']?></textarea>
						</div>
						<div class="form-group">
							<label for="moderate">Модерацию прошло</label>
							<input type="checkbox" name="moderate" id="moderate"<?php if ($comments[0]['active'] == 1) echo " checked";?>>
						</div>
						<input type="submit" class="btn btn-default" value="Добавить">
					</form>
                </div>
            </div>


        </div>
    </div>
</section>