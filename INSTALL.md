### Info

```
Laravel Installer 2.2.0
Laravel Framework 5.4.36
```


### git clone


### composer install


### env 

```
cp .env.example .env
```


### php artisan key:generate

### php artisan migrate


### config/database.php
```
	'mysql' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '127.0.0.1'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'forge'),
		'username' => env('DB_USERNAME', 'forge'),
		'password' => env('DB_PASSWORD', ''),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => true,
		'engine' => null,
		'modes'  => [
			'ONLY_FULL_GROUP_BY',
			'STRICT_TRANS_TABLES',
			'NO_ZERO_IN_DATE',
			'NO_ZERO_DATE',
			'ERROR_FOR_DIVISION_BY_ZERO',
			'NO_ENGINE_SUBSTITUTION',
		],
	],
```
### Storage ( must )
```
 ln -s 
 /path/Laravel-with-CRUD/storage/app/public 
 /path/Laravel-with-CRUD/public 
```

### [http://localhost:8000/](url)


#### Permisions 

filesystems.php

```
'local' => [
	'driver' => 'local',
	'root' => storage_path('app'), // before
	// 'root' => public_path('images/'),
],

chmod a+rwx storage 
```

more in Permisions.md
