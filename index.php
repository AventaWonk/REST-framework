<?php
namespace app;

include 'lib/router.php';
include 'settings.php';

use Router;

Router::start(Router::DENY_PUBLIC_ACCESS);
