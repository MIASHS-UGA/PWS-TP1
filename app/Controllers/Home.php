<?php

require_once 'app/Models/Article.php';
require_once 'app/View.php';

class Home
{
  function index()
  {
    $article_model = new Article();
    $articles = $article_model->list();

    $view_aside = new View([], ['form' => 'articles/form', 'get' => 'blocks/link_get_parameters', 'session' => 'blocks/link_session_variables'], 'aside', false);

    new View(['articles' => $articles], ['content' => 'articles/list', 'aside' => $view_aside]);
  }

  function add()
  {
    if (isset($_POST['ajout_article'])) {
      $article_model = new Article();
      $article_model->add($_POST);
    }

    $this->index();
  }
}
