<?php

require_once 'app/Models/Article.php';

class Home
{
  function index()
  {
    $article_model = new Article();

    $articles = $article_model->list();
    require "resources/views/template.php";
  }
}
