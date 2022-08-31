<?php 

Route::resource('/', 'GroupsController')->names('group')
->parameters(['' => 'group']);

Route::get('/create/{user_id}', 'GroupsController@create')
->name('group.create');

