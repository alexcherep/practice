<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><?=$news[0]['title']?></h2>
            <p class="blog-post-meta"><?=$news[0]['created_at']?></p>
            <div>
                Читающих сейчас: <?=rand(0,5)?> <br>
                Всего просмотров: 0
            </div>
            <p><?=$news[0]['text']?></p>
            <?php
            if ($tags) {
                echo '<p>Теги: ';
                foreach ($tags as $tag) {
                    echo '<a href="/tag/'.$tag['alias'].'">'.$tag['title'].'</a> ';
                }
                echo '</p>';
            }
			echo '<h3>Комментарии</h3>';
            echo $comments->getForm();
			if ($comments->getComments($news[0]['id'])) {
				foreach ($comments->getComments($news[0]['id']) as $comment) {
					echo  '<div class="panel panel-primary">
							<div class="panel-heading">
								<div style="float: left;">'.$comment['login'].' | '.$comment['date'].'</div>
								<div style="float: right;">';
									if ($comments->checkAcces($comment['commentId']))
									echo '<form method="post" action="">
											<input type="hidden" name="id" value="'.$comment['commentId'].'">
											<button class="rating btn-danger" type="submit" name="down">-</button> ';
									echo $comment['rating'];
									if ($comments->checkAcces($comment['commentId']))
										echo ' <button class="rating btn-success" type="submit" name="up">+</button>
										  </form>';
								echo '</div>
							</div>
							<div class="panel-body">'.nl2br($comment['message']).$comments->canEdit($comment['id'], $comment['timestamp']).'</div>
						  </div>';
				}
			}
            ?>
        </div>
    </div>
</div>