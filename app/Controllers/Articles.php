<?php

namespace App\Controllers;

class Articles
{
  function index()
  {
    $article_model = new \App\Models\Article();
    $articles = $article_model->list();

    $view_content = new \App\View(['articles' => $articles], ['content' => ['articles/list']], 'content', false);
    $view_aside = new \App\View([], ['form' => ['articles/form']], 'aside', false);
    new \App\View([], ['content' => $view_content, 'aside' => $view_aside]);

  }

  function add()
  {
    if (isset($_POST['ajout_article'])) {
      $article_model = new \App\Models\Article();
      $article_model->add($_POST);
    }

    $this->index();
  }

  function edit($id)
  {

    if (isset($_POST['edition_article'])) {
      $article_model = new \App\Models\Article();
      $article_model->update($_POST);
      return $this->index();
    }

    $article_model = new \App\Models\Article();
    $article_model = $article_model->get($id);

    $view_aside = new \App\View([], ['form' => 'articles/form', 'get' => 'blocks/link_get_parameters', 'session' => 'blocks/link_session_variables'], 'aside', false);

    new \App\View(['article' => $article_model], ['content' => 'articles/edit', 'aside' => $view_aside]);
  }

  function delete($id)
  {
    $article_model = new \App\Models\Article();
    $article_model->delete($id);
    $this->index();
  }
}
