<?php
namespace general;

include 'sql-generator.php';

use PDO;
use Settings;
use Exception;
use ReflectionClass;

/**
* Model
*/
class Model
{
  private $modelId = null;
  private static $foundModels;

  public static function getChildModelName() 
  {
    $function = new ReflectionClass(get_called_class());
    return $function->getShortName();
  }

  public static function getChildModel() 
  {
    return get_called_class();
  }

  public static function getChildTableName() 
  {
    return mb_convert_case(self::getChildModelName(), MB_CASE_LOWER) . "s";
  }

  public function getdModelName() 
  {
    $function = new ReflectionClass(get_called_class());
    return $function->getShortName();
  }

  public function getTableName() 
  {
    return mb_convert_case($this->getChildModelName(), MB_CASE_LOWER) . "s";
  }

  public static function add($model) 
  {
    $dbh = new PDO(...Settings::get()); 
    $sql = SqlGenerator::generateQuery(SqlGenerator::INSERT, $model);
    $sth = $dbh->prepare($sql["query"]);  
    $sth->execute($sql["params"]);
    $dbh = null;
  }

  public static function find($model) 
  {
    $dbh = new PDO(...Settings::get());
    $sql = SqlGenerator::generateQuery(SqlGenerator::SELECT, $model);
    $sth = $dbh->prepare($sql["query"]);
    $sth->execute($sql["params"]);
    $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, self::getChildModelName());  
    $foundModel = $sth->fetch();
    if ($foundModel) {
      $uid = uniqid();
      $foundModel->modelId = $uid;
      self::$foundModels[$uid] = $foundModel;
      $dbh = null;
      return clone $foundModel;
    } else {
      throw new Exception("Has not been found", 1);
    }
  }

  public static function findAll() 
  {
    $model = get_called_class();
    $rows = [];
    $dbh = new PDO(...Settings::get());
    $sql = SqlGenerator::generateQuery(SqlGenerator::SELECT_ALL, $model);
    $sth = $dbh->query($sql["query"]);  
    $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $model);  
    while($obj = $sth->fetch()) {  
        $rows[] = $obj;  
    }
    $dbh = null;
    return $rows;
  }

  public function save() {
    if (self::$foundModels[$this->modelId]) 
    {
      $dbh = new PDO(...Settings::get()); 
      $sql = SqlGenerator::generateQuery(SqlGenerator::UPDATE, $this, self::$foundModels[$this->modelId]);
      $sth = $dbh->prepare($sql["query"]);
      $sth->execute($sql["params"]);
      $dbh = null;
    } else {
      throw new Exception("Model was not found", 1);
    }
  }

  public function delete() 
  {
    $dbh = new PDO(...Settings::get()); 
    $sql = SQLGenerator::generateQuery(SqlGenerator::DELETE, $this);
    $sth = $dbh->prepare($sql["query"]);
    $sth->execute($sql["params"]);
    $dbh = null;
  }
  
  function __destruct() 
  {
    if ($this->modelId) {
      unset(self::$foundModels[$this->modelId]);
    }
  }
}
