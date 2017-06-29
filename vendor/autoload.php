<?php
function __autoload($className) {
  require_once '.' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className). '.php';
}
