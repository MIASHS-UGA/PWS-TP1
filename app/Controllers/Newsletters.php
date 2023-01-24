<?php

require_once 'app/Models/Newsletter.php';
require_once 'app/View.php';

class Newsletters
{
  function index()
  {
    $newsletter_model = new Newsletter();
    $newsletters = $newsletter_model->list();

    $view_content = new View(['newsletters' => $newsletters], ['content' => ['newsletters/list']], 'content', false);
    $view_aside = new View([], ['form' => 'newsletters/form'], 'aside', false);
    new View([], ['content' => $view_content, 'aside' => $view_aside]);
  }

  function add()
  {
    if (isset($_POST['ajout_newsletter'])) {
      $newsletter_model = new Newsletter();
      $newsletter_model->add($_POST);
    }

    $this->index();
  }

  function edit($id)
  {

    if (isset($_POST['edition_newsletter'])) {
      $newsletter_model = new Newsletter();
      $newsletter_model->update($_POST);
      return $this->index();
    }

    $newsletter_model = new Newsletter();
    $newsletter_model = $newsletter_model->get($id);

    $view_aside = new View([], ['form' => 'newsletters/form'], 'aside', false);

    new View(['newsletter' => $newsletter_model], ['content' => 'newsletters/edit', 'aside' => $view_aside]);
  }

  function delete($id)
  {
    $newsletter_model = new Newsletter();
    $newsletter_model->delete($id);
    $this->index();
  }
}
