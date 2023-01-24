<?php

\App\Route::get([
  '' => ['\App\Controllers\Home','index'],

  'articles' => ['\App\Controllers\Articles','index'],
  'articles/add' => ['\App\Controllers\Articles','add'],
  'articles/delete/{id}' => ['\App\Controllers\Articles','delete'],
  'articles/edit/{id}' => ['\App\Controllers\Articles','edit'],

  'newsletter' => ['\App\Controllers\Newsletter','index'],
  'newsletter/add' => ['\App\Controllers\Newsletter','add'],
  'newsletter/delete/{id}' => ['\App\Controllers\Newsletter','delete'],
  'newsletter/edit/{id}' => ['\App\Controllers\Newsletter','edit'],
]);
