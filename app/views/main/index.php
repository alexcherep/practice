<div>
	<div class="panel panel-primary tops">
		<div class="panel-heading"><h4>Топ 5 комментаторов</h4></div>
		<div class="panel-body">
			<ul class="list-unstyled">
		<?php
			foreach ($topUsers as $user) {
				echo '<li><a href="/user/'.$user['id'].'">'.$user['login'].'</a></li>';
			}
		?>
			</ul>
		</div>
	</div>
	
	<div class="panel panel-primary tops" style="position: absolute; margin-left: 60px; height: 197px;">
		<div class="panel-heading"><h4>Активные темы</h4></div>
		<div class="panel-body">
			<ul class="list-unstyled">
		<?php
			foreach ($topNewsToday as $topNews) {
				echo '<li><a href="/'.$topNews['category'].'/'.$topNews['alias'].'">'.$topNews['title'].'</a></li>';
			}
		?>
			</ul>
		</div>
	</div>
<?php
foreach ($categories as $category) {
    echo '<div class="news">';
    echo '<b><a href="'.$category['alias'].'">'.$category['name'].'</a></b>';
    echo '<ul class="list-unstyled">';
    if (isset($allNews[$category['id']])) {
        foreach ($allNews[$category['id']] as $news) {
            echo '<li>'.$news['date'].' <a href="/'.$category['alias'].'/'.$news['alias'].'">'.$news['title'].'</a></li>';
        }
    }
    echo '</ul>';
    echo '</div>';
}