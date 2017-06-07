<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Редактировать категорию</li>
                </ol>
            </div>


            <h4>Редактировать категорию</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                   <form method="post" action="">
						<div class="form-group">
							<label for="name">Название</label>
							<input type="text" class="form-control" name="name" id="name" value="<?=$category[0]['name']?>">
						</div>
						<div class="form-group">
							<label for="alias">Алиас</label>
							<input type="text" class="form-control" name="alias" id="alias" value="<?=$category[0]['alias']?>">
						</div>
						<input type="submit" class="btn btn-default" value="Редактировать">
					</form>
                </div>
            </div>


        </div>
    </div>
</section>