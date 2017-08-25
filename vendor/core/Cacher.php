<?php
namespace vendor\core;

/**
 * Cacher class
 */
class Cacher
{
  protected $fileURI;
  protected $cacheDir;

  /**
   * @param string $fileName
   * @param string $cacheDir
   */
  function __construct(string $fileName, $cacheDir = __DIR__ . DIRECTORY_SEPARATOR . 'cache')
  {
    $this->cacheDir = $cacheDir;
    $this->fileURI = $this->getCacheURI($fileName);
  }

  /**
   * @return array
   */
  public function getData() : array
  {
    if (file_exists($this->fileURI)) {
      return file($this->fileURI, FILE_IGNORE_NEW_LINES);
    }
  }

  /**
   * @param array $data
   */
  public function saveData($data)
  {
    if (!file_exists($this->cacheDir)) {
      mkdir($this->cacheDir, 0700);
    }
    $length = count($data);
    $file = fopen($this->fileURI, 'w');
    for ($i = 0; $i < $length; $i++) {
      fwrite($file, $data[$i]);
      fwrite($file, "\n");
    }
    fclose($file);
  }

  /**
   * @param string $fileName
   * @return string
   */
  protected function getCacheURI($fileName)
  {
    return $this->cacheDir . DIRECTORY_SEPARATOR . $fileName . '.tmp';
  }
}
