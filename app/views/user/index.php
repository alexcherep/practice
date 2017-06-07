<div>
	<ul>
<?php
foreach ($messages as $item) {
    echo '<li>'.$item['message'].'</li>';
}
?>
	</ul>
</div>

<?=$pagination->getHtml();?>