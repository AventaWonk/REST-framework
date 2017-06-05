<?php
  include 'lib/router.php';
  include 'settings.php';
  
  general\Router::start(general\Router::DENY_PUBLIC_ACCESS);
  