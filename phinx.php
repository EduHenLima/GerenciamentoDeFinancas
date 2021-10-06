<?php

require __DIR__ . '/vendor/autoload.php';
if(file_exists(__DIR__ . '/.env')){
    $dotenv = new \Dotenv\Dotenv(__DIR__);
    $dotenv->overload();
}
# Não será necessário se jogar em um .env
$db = include __DIR__ . '/config/db.php';

# Remover esse cara e jogar em um .env
list(
    'driver' => $driver,
    'host' => $host,
    'database' => $database,
    'username' => $user,
    'password' => $pass,
    'charset' => $charset,
    'collation' => $collation ) = $db['default_connection'];

return [
    'paths' => [
        'migrations' => [
            __DIR__ . '/db/migrations'
        ],
        'seeds' => [
            __DIR__ . '/db/seeds'
        ]
    ],
    # Poderiamos remover esse cara e fazer consumir de um .env
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'default_connection',
        'default_connection' => [
            'adapter' => $driver,
            'host' => $host,
            'name' => $database,
            'user' => $user,
            'pass' => $pass,
            'charset' => $charset,
            'collation' => $collation
        ]
    ]
];
