<?php

class MainController extends Controller
{
    public function index()
    {
        $obj = new Main();
        $news = [];
        $topUsers = $obj->getTopUserByComments();
        $topNewsToday = $obj->getTopNewsToday();
		
        $categories = $obj->findBySql('SELECT `name`, id, alias FROM categories');
        foreach ($categories as $category) {
			if ($category['alias'] == 'analytics') {
				$temp = $obj->findBySql("SELECT title, alias, DATE_FORMAT(created_at, '%H:%i') as `date`  FROM news WHERE isAnalytics = 1 ORDER BY updated_at DESC LIMIT 5");
			} else {
				$temp = $obj->findBySql("SELECT title, alias, DATE_FORMAT(created_at, '%H:%i') as `date`  FROM news WHERE category_id = ? ORDER BY updated_at DESC LIMIT 5", [$category['id']]);
			}
            if ($temp) {
                $news[$category['id']] = $temp;
            }
        }
        $this->set(['categories' => $categories, 'allNews' => $news, 'topUsers' => $topUsers, 'topNewsToday' => $topNewsToday]);
    }
}