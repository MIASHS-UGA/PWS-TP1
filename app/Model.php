<?php

namespace App;

use Exception;

abstract class Model
{
  protected $pdo;
  protected $tablename = 'db_table_name';
  protected $pk_name = 'db_pk_name';
  protected $fields = [];

  function __construct()
  {
    try {
      $this->pdo = new \PDO('sqlite:' . DB_PATH);
    } catch (Exception $e) {
      print "Erreur de connexion à la base de données : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function list()
  {
    try {

      $query = $this->pdo->prepare('SELECT * FROM ' . $this->tablename);
      $query->execute();
      return $query->fetchAll(\PDO::FETCH_CLASS);
    } catch (Exception $e) {
      print "Erreur fonction list() dans le modèle " . get_class($this) . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function get($id)
  {
    try {
      $query = $this->pdo->prepare('SELECT * FROM ' . $this->tablename . ' WHERE ' . $this->pk_name . ' = ? LIMIT 1');
      $query->execute([$id]);
      return $query->fetchObject();
    } catch (Exception $e) {
      print "Erreur fonction list() dans le modèle " . get_class($this) . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }

function add($data)
{
  try {

    //Variable pour construire la requête
    $at_least_one_value = false;
    $sql_query_start = 'INSERT INTO ' . $this->tablename . ' (';
    $sql_query_end = 'VALUES (';
    $pdo_execute = [];

    foreach ($this->fields as $field) { //On boucle sur ls noms des colonnes
      if (isset($data[$field])) { //Si on trouve la colonne dans le tableau $data
        $at_least_one_value = true; //Au moins une valeur trouvée, on executera la requête
        $sql_query_start .= '"' . $field . '",'; //on ajoute le nom de la colonne en cours
        $sql_query_end .= '?,'; //we add the ? for the pdo execute
        $pdo_execute[] = $data[$field]; //we add the value
      }
    }

    if ($at_least_one_value) {

      $sql_query =  substr($sql_query_start, 0, -1) . ') ' . substr($sql_query_end, 0, -1) . ')'; //on retire les dernières virgules ajoutées au strigns et on ferme les parenthèse

      $query = $this->pdo->prepare($sql_query);
      $query->execute($pdo_execute);
      return true;
    }
    return false;
  } catch (Exception $e) {
    print "Erreur fonction add($data) dans le modèle " . get_class($this) . "  : " . $e->getMessage() . "<br/>";
    die();
  }
}

  function update($data)
  {
    try {

      //On vérifie que $data contient bien une valeur pour la clé primaire
      if(!isset($data[$this->pk_name])) return false; //sinon on annule
      $id = $data[$this->pk_name]; //on stocke la valeur de la clé primaire
      unset($data[$this->pk_name]); //on supprime cette entrée dans $data, pour ne pas avoir de problème lors de la construction de la requête SQL

      //Variable pour construire la requête
      $at_least_one_value = false;
      $sql_query = 'UPDATE ' . $this->tablename . ' SET ';
      $pdo_execute = [];

      foreach ($this->fields as $field) { //On boucle sur ls noms des colonnes
        if (isset($data[$field])) { //Si on trouve la colonne dans le tableau $data
          $at_least_one_value = true; //Au moins une valeur trouvée, on executera la requête
          $sql_query .= '"' . $field . '" = ?,'; //on ajoute le nom de la colonne en cours
          $pdo_execute[] = $data[$field]; //we add the value
        }
      }

      $pdo_execute[] = $id; //On ajoute la valeur de la clé primaire à la fin du tableau pour l'execution PDO

      if ($at_least_one_value) {

        $sql_query =  substr($sql_query, 0, -1) . ' WHERE '.$this->pk_name.' = ?'; //on retire les dernières virgules ajoutées au strigns et on ferme les parenthèse

        $query = $this->pdo->prepare($sql_query);
        $query->execute($pdo_execute);
        return true;
      }

      return false;
    } catch (Exception $e) {
      print "Erreur fonction add($data) dans le modèle Article : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function delete($id)
  {
    try {

      $query = $this->pdo->prepare('DELETE FROM ' . $this->tablename . ' WHERE ' . $this->pk_name . ' = ?');
      return $query->execute([$id]);
    } catch (Exception $e) {
      print "Erreur fonction delete dans le modèle " . get_class($this) . " : " . $e->getMessage() . "<br/>";
      die();
    }
  }
}
