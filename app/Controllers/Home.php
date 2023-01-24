<?php

require_once 'app/Models/Article.php';
require_once 'app/View.php';

class Home
{
  function index()
  {
    $article_model = new Article();
    $articles = $article_model->list();

    $newsletter_model = new Newsletter();
    $newsletters = $newsletter_model->list();

    $view_content = new View(['articles' => $articles, 'newsletters' => $newsletters], ['content' => ['articles/list', 'newsletters/list']], 'content', false);
    $view_aside = new View([], ['form' => ['articles/form', 'newsletters/form']], 'aside', false);
    new View([], ['content' => $view_content, 'aside' => $view_aside]);
  }
}
