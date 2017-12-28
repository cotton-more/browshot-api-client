<?php

require_once __DIR__.'/vendor/autoload.php';

use BrowshotAPI\Command\ProtobufCompileCommand;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(__DIR__.'/.env.dist', __DIR__.'/.env');

$application = new Silly\Application('BrowshotAPI', '0.0.0');

$container = \DI\ContainerBuilder::buildDevContainer();

$application->useContainer($container);

$application->command('protobuf:compile', ProtobufCompileCommand::class, ['compile']);

/** @noinspection PhpUnhandledExceptionInspection */
$application->run();