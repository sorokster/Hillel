<?php declare(strict_types=1);

namespace Hillel\Project\Core\ORM\ActiveRecord;

use Illuminate\Database\Capsule\Manager;

class DatabaseConnection
{
    const DRIVER = 'mysql';
    const HOST = 'db';
    const PREFIX = '';
    const CHARSET = 'utf8';
    const COLLATION = 'utf8_unicode_ci';

    public function __construct(
        string $database,
        string $user,
        string $pass,
        string $port,
        string $host = self::HOST,
        string $dbDriver = self::DRIVER,
        string $prefix = self::PREFIX,
        string $charset = self::CHARSET,
        string $collation = self::COLLATION
    )
    {
        $dbManager = new Manager();
        $dbManager->addConnection([
            'driver' => $dbDriver,
            'host' => $host,
            'database' => $database,
            'username' => $user,
            'password' => $pass,
            'port' => $port,
            'charset' => $charset,
            'collation' => $collation,
            'prefix' => $prefix,
        ]);

        $dbManager->bootEloquent();
    }
}
