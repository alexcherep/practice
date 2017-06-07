<?php
$obj = new Model();
$arr = array_column($obj->getCategory(), 'alias');
$categories = implode('|', $arr);


return [
    "($categories)" => 'news/index/$1',
	"($categories)/([a-z0-9-]+)" => 'news/show/$2',
    "($categories)/page-([0-9]+)" => 'news/index/$1/$2',
	
    'tag/([a-z-]+)' => 'news/tag/$1',
    'tag/([a-z-]+)/page-([0-9]+)' => 'news/tag/$1/$2',
	
    'register' => 'user/register',
    'login' => 'user/login',
    'user/([0-9]+)' => 'user/index/$1',
	'user/([0-9]+)/page-([0-9]+)' => 'user/index/$1/$2',
	
	'admin' => 'admin/index',
	'admin/category' => 'adminCategory/index',
	'admin/category/create' => 'adminCategory/create',
	'admin/category/edit/([0-9]+)' => 'adminCategory/edit/$1',
	'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
	
	'admin/news' => 'adminNews/index',
	'admin/news/create' => 'adminNews/create',
	'admin/news/edit/([0-9]+)' => 'adminNews/edit/$1',
	'admin/news/delete/([0-9]+)' => 'adminNews/delete/$1',
	
	'admin/comments' => 'adminComments/index',
	'admin/comments/edit/([0-9]+)' => 'adminComments/edit/$1',
	'admin/comments/delete/([0-9]+)' => 'adminComments/delete/$1',
	'admin/comments/check' => 'adminComments/check',
	
	'admin/style' => 'admin/style',
	
    '' => 'main/index',
];