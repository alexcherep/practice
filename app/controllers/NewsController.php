<?php

class NewsController extends Controller
{
    public function index($category, $page = 1)
    {
        $obj = new News();
        $news = $obj->getNewsByCategory($category, $page);
        $countNews = $obj->getTotalNews($category);

        $pagination = new Pagination($countNews, $page, $obj::COUNT_NEWS_ON_PAGE, 'page-');

        $this->set(['news' => $news, 'pagination' => $pagination, 'category' => $category]);
    }

    public function show($alias)
    {		
        $obj = new News();
        $news = $obj->findOne($alias, 'alias');
		if (!$news) {
			header('Location: /');
		}
		
        $news[0]['text'] = ($news[0]['isAnalytics'] && !isset($_SESSION['user'])) ? $obj->isAnalytics($news[0]['text']) : $news[0]['text'];

        $tags = $obj->findBySql('SELECT t.id, t.title, t.alias 
                                 FROM tags2news tn LEFT JOIN tags t ON tn.tag_id = t.id 
                                 WHERE news_id = (SELECT id FROM news WHERE alias = ?)', [$alias]);
		
		$comments = new Comment('comments', $obj->getId($alias), $obj->isPolitics($news[0]['category_id']));
		if (isset($_POST['up']) and isset($_SESSION['user'])) {
			$comments->plusRating($_POST['id'], $_SESSION['user']);
		}
		
		if (isset($_POST['down']) and isset($_SESSION['user'])) {
			$comments->minusRating($_POST['id'], $_SESSION['user']);
		}
		
		
		if (isset($_POST['comment']) and isset($_SESSION['user'])) {
			$comments->save($_POST['message']);
		}
		
        $this->set(['news' => $news, 'tags' => $tags, 'comments' => $comments]);
    }

    public function tag($alias, $page = 1)
    {
        $obj = new News();
        $news = $obj->getNewsByTag($alias, $page);
        $countNews = $obj->getTotalNewsByTag($alias);
        
        $pagination = new Pagination($countNews, $page, $obj::COUNT_NEWS_ON_PAGE, 'page-');

        $this->set(['news' => $news, 'pagination' => $pagination]);
    }
}