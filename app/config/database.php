<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;

return [
    PDO::class => function (ContainerInterface $container): PDO {
        $host = $_ENV['HOST'] ?? 'localhost';
        $dbname = $_ENV['DB_NAME'] ?? '';
        $user = $_ENV['USERNAME'] ?? 'root';
        $pass = $_ENV['PASSWORD'] ?? '';

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    },
];