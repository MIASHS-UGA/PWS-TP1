<?php

class Route
{
  public static function get($routes = [])
  {

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //on récupère l'URL
    $path_array = explode('/', $path); //on construit un tableau avec les différentes parties de l'url

    //On reconstruit le nom de la route
    $path_controller = $path_array[1];
    if (isset($path_array[2])) $path_controller .= '/' . $path_array[2];
    $id = '';
    if (isset($path_array[3])) {
      $path_controller .= '/{id}';
      $id = $path_array[3];
    }

    if (key_exists($path_controller, $routes)) { //On regarde si l'url existe dans le tableau $routes

      $controller_name = $routes[$path_controller][0]; //on récupère le nom du Controller
      $action_name = $routes[$path_controller][1]; //on récupère le nom de l'action

      if (class_exists($controller_name) and method_exists($controller_name, $action_name)) { //On teste si le controller et la fonction existent
        $controller = new $controller_name; //on instancie le Controller
        $controller->$action_name($id); //on appelle la fonction correspondante
      } else {
        http_response_code(404);
        echo 'Controller ou fonction n\'existe pas';
      }
    } else {
      http_response_code(404);
      echo 'page non trouvée';
    }

  }
}
