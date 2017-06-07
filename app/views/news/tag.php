<?php
foreach ($news as $item) {
    echo '<div>';
    echo '<ul>';
    echo '<li>'.$item['date'].' <a href="/'.$item['category'].'/'.$item['alias'].'">'.$item['title'].'</a></li>';
    echo '</ul>';
    echo '</div>';
}
echo $pagination->getHtml();