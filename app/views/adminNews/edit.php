<section>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Редактировать новость</li>
                </ol>
            </div>


            <h4>Редактировать новость</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                   <form method="post" action="">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" id="name" value="<?=$news[0]['title']?>">
						</div>
						<div class="form-group">
							<label for="alias">Алиас</label>
							<input type="text" class="form-control" name="alias" id="alias" value="<?=$news[0]['alias']?>">
						</div>
						<div class="form-group">
							<label for="text">Текст</label>
							<textarea class="form-control" name="text" id="text"><?=$news[0]['text']?></textarea>
						</div>
						<div class="form-group">
							<label for="category">Категория</label>
							<select name="category" id="category">
							<?php
								foreach ($categoriesList as $category) :
							?>
								<option value="<?=$category['id']?>"<?php if ($category['id'] == $news[0]['category_id']) echo " selected";?>><?=$category['name']?></option>
							<?php
								endforeach;
							?>
							</select>
						</div>
						<input type="submit" class="btn btn-default" value="Добавить">
					</form>
                </div>
            </div>


        </div>
    </div>
</section>