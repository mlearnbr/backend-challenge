<?php 

Route::resource('/', 'UsersController')->names('user')
->parameters(['' => 'user']);

Route::post('/filter', 'UsersController@filter')
->name('user.filter');

