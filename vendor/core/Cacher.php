<?php
namespace vendor\core;

/**
 *
 */
class Cacher
{
  protected $fileURI;
  protected $cacheDir;

  function __construct(string $fileName, $cacheDir = DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR)
  {
    $this->fileURI = $this->getCacheURI($fileName);
    $this->cacheDir = $cacheDir;
  }

  public function getData()
  {
    if (file_exists($this->fileURI)) {
      return file($this->fileURI, FILE_IGNORE_NEW_LINES);
    }
  }

  public function saveData($data)
  {
    $length = count($data);
    $file = fopen($this->fileURI, 'w');
    for ($i = 0; $i < $length; $i++) {
      fwrite($file, $data[$i]);
      fwrite($file, "\n");
    }
    fclose($file);
  }

  protected function getCacheURI($fileName)
  {
    // return $this->cacheDir . $fileName . '.tmp';
    return $fileName . '.tmp';
  }
}
