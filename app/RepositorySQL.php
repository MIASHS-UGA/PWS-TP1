<?php

namespace App;

use Exception;

class RepositorySQL extends Repository
{
  static $tablename = 'db_table_name';
  static $pk_name = 'db_pk_name';
  static $fields = [];
  static $modelname = '\App\Model';

  static function db()
  {
    try {
      return new \PDO('sqlite:' . DB_PATH);
    } catch (Exception $e) {
      print "Erreur de connexion à la base de données : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  static function list()
  {
    try {
      $query = self::db()->prepare('SELECT * FROM ' . static::$tablename);
      $query->execute();
      $models = [];
      foreach ($query->fetchAll(\PDO::FETCH_ASSOC) as $data) {
        $models[] = new static::$modelname($data);
      }
      return $models;
    } catch (Exception $e) {
      print "Erreur fonction list() dans le repository SQL " . get_class() . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  static function get($id)
  {
    try {
      $query = self::db()->prepare('SELECT * FROM ' . static::$tablename . ' WHERE ' . static::$pk_name . ' = ? LIMIT 1');
      $query->execute([$id]);
      return new static::$modelname($query->fetch());
    } catch (Exception $e) {
      print "Erreur fonction list() dans le repository SQL " . get_class() . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  static function add($data)
  {
    try {

      //Variable pour construire la requête
      $at_least_one_value = false;
      $sql_query_start = 'INSERT INTO ' . static::$tablename . ' (';
      $sql_query_end = 'VALUES (';
      $pdo_execute = [];

      foreach (static::$fields as $field) { //On boucle sur ls noms des colonnes
        if (isset($data[$field])) { //Si on trouve la colonne dans le tableau $data
          $at_least_one_value = true; //Au moins une valeur trouvée, on executera la requête
          $sql_query_start .= '"' . $field . '",'; //on ajoute le nom de la colonne en cours
          $sql_query_end .= '?,'; //we add the ? for the pdo execute
          $pdo_execute[] = $data[$field]; //we add the value
        }
      }

      if ($at_least_one_value) {

        $sql_query = substr($sql_query_start, 0, -1) . ') ' . substr($sql_query_end, 0, -1) . ')'; //on retire les dernières virgules ajoutées au strigns et on ferme les parenthèse

        $query = self::db()->prepare($sql_query);
        return $query->execute($pdo_execute);
      }
      return false;
    } catch (Exception $e) {
      print "Erreur fonction add($data) dans le repository SQL " . get_class() . "  : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  static function update($data)
  {
    try {

      //On vérifie que $data contient bien une valeur pour la clé primaire
      if (!isset($data[static::$pk_name]))
        return false; //sinon on annule
      $id = $data[static::$pk_name]; //on stocke la valeur de la clé primaire
      unset($data[static::$pk_name]); //on supprime cette entrée dans $data, pour ne pas avoir de problème lors de la construction de la requête SQL

      //Variable pour construire la requête
      $at_least_one_value = false;
      $sql_query = 'UPDATE ' . static::$tablename . ' SET ';
      $pdo_execute = [];

      foreach (static::$fields as $field) { //On boucle sur ls noms des colonnes
        if (isset($data[$field])) { //Si on trouve la colonne dans le tableau $data
          $at_least_one_value = true; //Au moins une valeur trouvée, on executera la requête
          $sql_query .= '"' . $field . '" = ?,'; //on ajoute le nom de la colonne en cours
          $pdo_execute[] = $data[$field]; //we add the value
        }
      }

      $pdo_execute[] = $id; //On ajoute la valeur de la clé primaire à la fin du tableau pour l'execution PDO

      if ($at_least_one_value) {

        $sql_query = substr($sql_query, 0, -1) . ' WHERE ' . static::$pk_name . ' = ?'; //on retire les dernières virgules ajoutées au strigns et on ferme les parenthèse

        $query = self::db()->prepare($sql_query);
        $query->execute($pdo_execute);
        return true;
      }

      return false;
    } catch (Exception $e) {
      print "Erreur fonction add($data) dans le repository SQL : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  static function delete($id)
  {
    try {

      $query = self::db()->prepare('DELETE FROM ' . static::$tablename . ' WHERE ' . static::$pk_name . ' = ?');
      return $query->execute([$id]);
    } catch (Exception $e) {
      print "Erreur fonction delete dans le repository SQL " . get_class() . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }
}