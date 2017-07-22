<?php
require_once('vendor/autoload.php');

use vendor\core\Router;

$settings = [
  'access-control' => [
    'origin' => 'ALL',
    'methods' => [
      'GET',
      'POST'
    ]
  ],
  'db' => [
    'host' => 'localhost',
    'name' => 'dbname',
    'user' => 'root',
    'password' => '',
    'charset' => 'utf8'
  ],
];

Router::start($settings);
