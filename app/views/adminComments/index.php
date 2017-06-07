<section>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление комментариями</li>
                </ol>
            </div>
            <a href="/admin/comments/check" class="btn btn-default back"><i class="fa fa-plus"></i> Комментарии для проверки</a>
            <h4>Список комментариев</h4>
            <br/>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID комментария</th>
                    <th>Сообщение</th>
                    <th>Название новости</th>
                    <th>Логин отправителя</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($commentsList as $comment): ?>
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo $comment['message']; ?></td>
                        <td><?php echo $comment['title']; ?></td>
                        <td><?php echo $comment['login']; ?></td>
                        <td><a href="/admin/comments/edit/<?php echo $comment['id']; ?>">Редактировать</a></td>
                        <td><a href="/admin/comments/delete/<?php echo $comment['id']; ?>">Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table> 
        </div>
    </div>
</section>