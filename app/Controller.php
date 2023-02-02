<?php

namespace App;

abstract class Controller
{
  protected $repository;
  protected $model_name_single = '';
  protected $folder_name = '';

  function index()
  {
    $models = $this->repository::list();

    $view_content = new \App\View([$this->folder_name => $models], ['content' => [$this->folder_name.'/list']], 'content', false);
    $view_aside = new \App\View([], ['form' => [$this->folder_name.'/form']], 'aside', false);
    new \App\View([], ['content' => $view_content, 'aside' => $view_aside]);
  }

  function add()
  {
    if (!empty($_POST)) {
      $this->repository::add($_POST);
    }

    $this->index();
  }

  function edit($id)
  {
    if (!empty($_POST)) {
      $this->repository::update($_POST);
      return $this->index();
    }

    $view_aside = new \App\View([], ['form' => $this->folder_name.'/form'], 'aside', false);

    new \App\View([$this->model_name_single => $this->repository::get($id)], ['content' => $this->folder_name.'/edit', 'aside' => $view_aside]);
  }

  function delete($id)
  {
    $this->repository::delete($id);
    $this->index();
  }
}
