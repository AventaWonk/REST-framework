<?php
namespace vendor\database;

/**
* SQL generator for PDO
*/
class SQLGenerator
{
  const INSERT = "INSERT INTO %s %s VALUES %s";
  const SELECT = "SELECT %s FROM %s WHERE %s";
  const SELECT_ALL = "SELECT %s from %s";
  const UPDATE = "UPDATE %s SET %s WHERE %s";
  const DELETE = "DELETE FROM %s WHERE %s";

  protected static function generateInsert($model)
  {
    $availableParams = [];
    $params = "";
    $values = "";

    $i = 0;
    foreach ($model as $key => $name) {
      $availableParams[$key] = $name;
      if($i == 0) {
        $params .= $key;
        $values .= ":" . $key;
      } else {
        $params .= ", " . $key;
        $values .= ", :" . $key;
      }
      $i++;
    }

    $params = "(" . $params . ")";
    $values = "(" . $values . ")";

    return [
      "query" => sprintf(self::INSERT, $model->getTableName(), $params, $values),
      "params" => $availableParams,
    ];
  }

  protected static function generateSelect($model)
  {
    $availableParams = [];
    $whereString = "";

    $i = 0;
    foreach ($model as $key => $name) {
      if($i == 0) {
        $params = $key;
        $whereString = $key . " = :" . $key;
        if($name) {
          $availableParams[$key] = $name;
          $whereString = $key . " = :" . $key;
        }
      } else {
        $params .= ", " . $key;
        if($name) {
          $availableParams[$key] = $name;
          $whereString .= " AND " . $key . " = :" . $key;
        }
      }
      $i++;
    }

    return [
      "query" => sprintf(self::SELECT, $params, $model->getTableName(), $whereString),
      "params" => $availableParams,
    ];
  }

  protected static function generateDelete($model)
  {
    $availableParams = [];
    $whereString = "";

    $i = 0;
    foreach ($model as $key => $name) {
      if($i == 0) {
        if($name) {
          $availableParams[$key] = $name;
          $whereString .= $key . " = :" . $key;
        }
      } else {
        if($name) {
          $availableParams[$key] = $name;
          $whereString .= " AND " . $key . " = :" . $key;
        }
      }
      $i++;
    }

    return [
      "query" => sprintf(self::DELETE, $model->getTableName(), $whereString),
      "params" => $availableParams,
    ];
  }

  protected static function generateSelectAll($modelName)
  {
    $i = 0;
    $model = get_class_vars($modelName::getChildModel());
    foreach ($model as $key => $value) {
      if($i == 0) {
        $columns = $key;
      } else {
        $columns .= ", " . $key;
      }
      $i++;
    }

    return [
      "query" => sprintf(self::SELECT_ALL, $columns, $model::getChildTableName()),
    ];
  }

  // protected static function generateSelectById($model)
  // {
  //   $i = 0;
  //   $model = get_class_vars($model::getChildModel());
  //   foreach ($model as $key => $value) {
  //     if($i == 0) {
  //       $columns = $key;
  //     } else {
  //       $columns .= ", " . $key;
  //     }
  //     $i++;
  //   }
  //
  //   return [
  //     "query" => sprintf(self::SELECT_ALL, $columns, $model::getChildTableName()),
  //   ];
  // }

   protected static function generateUpdate($newModel, $previousModel)
   {
    $availibleParams = [];
    $whereString = "";
    $setString = "";

    $i = 0;
    foreach ($newModel as $key => $name) {
      if($i == 0) {
        if($name) {
          $availibleParams["new_" . $key] = $name;
          $setString .= $key . " = :new_" . $key;
        }
      } else {
        if($name) {
          $availibleParams["new_" . $key] = $name;
          $setString .= ", " . $key . " = :new_" . $key;
        }
      }
      $i++;
    }

    $i = 0;
    foreach ($previousModel as $key => $name) {
      if($i == 0) {
        if($name) {
          $availibleParams[$key] = $name;
          $whereString .= $key . " = :" . $key;
        }
      } else {
        if($name) {
          $availibleParams[$key] = $name;
          $whereString .= " AND " . $key . " = :" . $key;
        }
      }
      $i++;
    }

    return [
      "query" => sprintf(self::UPDATE, $newModel->getTableName(), $setString, $whereString),
      "params" => $availibleParams,
    ];
  }

  public static function generateQuery($query, $model, $previousModel = 0)
  {
    switch ($query) {
      case self::INSERT:
        return self::generateInsert($model);
        break;

      case self::SELECT:
        return self::generateSelect($model);
        break;

      case self::SELECT_ALL:
        return self::generateSelectAll($model);
        break;

      case self::UPDATE:
        return self::generateUpdate($model, $previousModel);
        break;

      case self::DELETE:
        return self::generateDelete($model);
        break;
    }
  }
}
