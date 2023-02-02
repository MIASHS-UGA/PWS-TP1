<?php

function autoload($class)
{
  //Liste des répertoires à explorer pour essayer de trouver la classe
  $folders = ['app/', 'app/Controllers/', 'app/Models/', 'app/Repositories/'];

  //Nettoyage du nom de la classe
  //Le nom de la class appellée avec le namespace est du type "App\Models\Article" pour une classe Article
  //Avec les fonctions substr et strrpos, on récupère la dernière partie du nom, après le \, soit par exemple Article pour "App\Models\Article"
  $class = substr($class, strrpos($class, '\\') + 1);

  foreach ($folders as $folder) { //on boucle sur la liste de répertoires
    if (is_file($folder . $class . '.php')) { //si le fichier existe dans ce répertoire
      require_once $folder . $class . '.php'; //on l'inclut
    }
  }
}
spl_autoload_register('autoload'); //inscrire notre fonction autoload() dans le chargement automatique des classes de PHP