<?php

//On inclut la classe Route
require_once 'app/Route.php';

//On doit inclure tous les Controllers dont on veut disposer
require_once 'app/Controllers/Home.php';

Route::get([
  '' => ['Home','index'],
  'articles/add' => ['Home','add'],
  'articles/delete/{id}' => ['Home','delete'],
  'articles/edit/{id}' => ['Home','edit'],
]);
