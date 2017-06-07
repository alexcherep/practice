<div>
	<ul>
<?php
foreach ($news as $item) {
    echo '<li>'.$item['date'].' <a href="/'.$category.'/'.$item['alias'].'">'.$item['title'].'</a></li>';
}
?>
	</ul>
</div>

<?=$pagination->getHtml();?>