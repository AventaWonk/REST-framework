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
];

Router::start($settings);
