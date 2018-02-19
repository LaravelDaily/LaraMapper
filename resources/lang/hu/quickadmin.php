<?php

return [
		'user-management' => [		'title' => 'User management',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'categories' => [		'title' => 'Categories',		'fields' => [			'name' => 'Name',		],	],
		'cities' => [		'title' => 'Cities',		'fields' => [			'name' => 'Name',		],	],
		'stores' => [		'title' => 'Stores',		'fields' => [			'categories' => 'Categories',			'city' => 'City',			'name' => 'Name',			'description' => 'Description',			'address' => 'Address',			'phone' => 'Phone',			'photo' => 'Photo',		],	],
	'qa_create' => 'Létrehozás',
	'qa_save' => 'Mentés',
	'qa_edit' => 'Szerkesztés',
	'qa_view' => 'Megtekintés',
	'qa_update' => 'Frissítés',
	'qa_list' => 'Lista',
	'qa_no_entries_in_table' => 'Nincs bejegyzés a táblában',
	'qa_logout' => 'Kijelentkezés',
	'qa_add_new' => 'Új hozzáadása',
	'qa_are_you_sure' => 'Biztosan így legyen?',
	'qa_back_to_list' => 'Vissza a listához',
	'qa_dashboard' => 'Vezérlőpult',
	'qa_delete' => 'Törlés',
	'qa_custom_controller_index' => 'Egyedi vezérlő index.',
	'quickadmin_title' => 'LaraMapper',
];