<?php 

return [
	'/' => 'index/index',
	'/admin' => 'admin/index',
	'/admin/categories' => 'admin/categories',
	'/admin/categories/edit/(\d+)' => 'admin/editCategory/$1',
	'/catalog' => 'catalog/index',
	'/catalog/(\d+)' => 'catalog/category/$1'
];