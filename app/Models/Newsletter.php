<?php
class Newsletter
{
  protected $pdo;

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

      $query = $this->pdo->prepare('SELECT * FROM newsletter');
      $query->execute();
      return $query->fetchAll(PDO::FETCH_CLASS);
    } catch (Exception $e) {
      print "Erreur fonction list() dans le modèle Newsletter : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function add($data)
  {
    try {

      if (isset($data['newsletter_email'])) {
        $query = $this->pdo->prepare('INSERT INTO newsletter ("newsletter_email") VALUES (?)');
        $query->execute([$data['newsletter_email']]);
        return true;
      }
      return false;
    } catch (Exception $e) {
      print "Erreur fonction add($data) dans le modèle Newsletter : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function get($id)
  {
    try {
      $query = $this->pdo->prepare('SELECT * FROM newsletter WHERE newsletter_id = ? LIMIT 1');
      $query->execute([$id]);
      return $query->fetchObject();
    } catch (Exception $e) {
      print "Erreur fonction list() dans le modèle Newsletter : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function update($data)
  {
    try {
      if (isset($data['newsletter_id']) && isset($data['newsletter_email'])) {
        $query = $this->pdo->prepare('UPDATE  newsletter SET "newsletter_email" = ? WHERE newsletter_id = ?');
        $query->execute([$data['newsletter_email'], $data['newsletter_id']]);
        return true;
      }
      return false;
    } catch (Exception $e) {
      print "Erreur fonction add($data) dans le modèle Newsletter : " . $e->getMessage() . "<br/>";
      die();
    }
  }

  function delete($id)
  {
    try {

      $query = $this->pdo->prepare('DELETE FROM newsletter WHERE newsletter_id = ?');
      return $query->execute([$id]);
    } catch (Exception $e) {
      print "Erreur fonction delete dans le modèle Newsletter : " . $e->getMessage() . "<br/>";
      die();
    }
  }
}
