<?php 

return [
	'/' => 'index/index',
	'/admin' => 'admin/index',
	'/admin/categories' => 'admin/categories',
	'/admin/categories/edit/(\d+)' => 'admin/editCategory/$1',
	'/admin/products' => 'admin/products',
	'/admin/products/edit/(\d+)' => 'admin/editProduct/$1',
	'/catalog' => 'catalog/index',
	'/catalog/(\d+)' => 'catalog/category/$1',
	'/catalog/(\d+)/(\d+)' => 'catalog/product/$1/$2'
];