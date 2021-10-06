<?php


// Todo: revisar esse username
// Todo: Está sendo necessário mudar username para user quando rodar a migrate - validar
return [
    'default_connection' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'uft_unicode_ci'
    ]
];

