<?php

namespace App\Controllers;

class Home
{
  function index()
  {
    $article_model = new \App\Models\Article();
    $articles = $article_model->list();

    $newsletter_model = new \App\Models\Newsletter();
    $newsletters = $newsletter_model->list();

    $view_content = new \App\View(['articles' => $articles, 'newsletters' => $newsletters], ['content' => ['articles/list', 'newsletters/list']], 'content', false);
    $view_aside = new \App\View([], ['form' => ['articles/form', 'newsletters/form']], 'aside', false);
    new \App\View([], ['content' => $view_content, 'aside' => $view_aside]);
  }
}
