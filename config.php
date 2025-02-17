<?php
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('BASE_URL', $_ENV['BASE_URL']);