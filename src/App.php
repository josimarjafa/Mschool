<?php

require 'vendor/autoload.php';

require "src/Database.php";
require 'src/School.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \Monolog\Formatter\LineFormatter;

class App {

    public static $database;
    public static $logger;


    public static function init()
    {
        // logger

        self::$logger = new \Monolog\Logger('Mschool');
        $handler = new StreamHandler('log.log', Logger::DEBUG);
        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n"));
        self::$logger->pushHandler($handler);
        $handler = new StreamHandler('php://stdout', Logger::INFO);
        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n"));
        self::$logger->pushHandler($handler);



        // database
        self::$logger->info('Database setup');
        self::$database = new Database();
        $db = (self::$database)->connect();
        if ($db != null)
            self::$logger->info('Database Ready');
        else
            self::$logger->debug('Unable to setup Database');
    }


}

App::init();
