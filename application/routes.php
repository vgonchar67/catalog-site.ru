<?php 

return [
	'/add' => 'index/add',
	'/' => 'index/index',
	'/captcha' => 'captcha/index',
	'/admin/auth' => 'admin/auth',
	'/admin' => 'admin/index',
	'/admin/edit/(\d+)' => 'admin/edit/$1',
	'/admin/delete' => 'admin/delete',
	'/auth/logout' => 'auth/logout'
];