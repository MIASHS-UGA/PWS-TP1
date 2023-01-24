<?php

//On inclut la classe Route
require_once 'app/Route.php';

//On doit inclure tous les Controllers dont on veut disposer
require_once 'app/Controllers/Home.php';
require_once 'app/Controllers/Articles.php';
require_once 'app/Controllers/Newsletters.php';

Route::get([
  '' => ['Home','index'],

  'articles' => ['Articles','index'],
  'articles/add' => ['Articles','add'],
  'articles/delete/{id}' => ['Articles','delete'],
  'articles/edit/{id}' => ['Articles','edit'],

  'newsletter' => ['Newsletters','index'],
  'newsletter/add' => ['Newsletters','add'],
  'newsletter/delete/{id}' => ['Newsletters','delete'],
  'newsletter/edit/{id}' => ['Newsletters','edit'],
]);
