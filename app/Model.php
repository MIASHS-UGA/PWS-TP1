<?php

namespace App;

use Exception;

abstract class Model
{
  public function __construct($data)
  {
    $this->hydrate($data);
  }

  /**
   * Compare un tableau de données avec les attributs de la classe
   * S'il y a match entre un attribut et une des clés de $data
   * Et que la fonction setter existe pour l'attribut
   * Alors on déclenche le setter avec la valeur
   * @param mixed $data
   * @return void
   */
  public function hydrate($data)
  {
    $attributes = get_object_vars($this); //récupère les attributs de la classe / de l'objet

    foreach ($data as $key => $value) {
      if (key_exists($key, $attributes)) {
        $setterMethodName = $this->toSetterMethodeName($key);
        if (method_exists($this, $setterMethodName))
          $this->$setterMethodName($value);
      }
    }
  }

  /**
   * Transforme un nom d'attribut en nom de sa fonction setter
   * @param string $attribute, par exemple article_id
   * @return string le nom de la fonction setter, par exemple setArticleID
   */
  protected function toSetterMethodeName($attribute)
  {
    return 'set' . implode(array_map('ucfirst', explode('_', $attribute)));
  }

}