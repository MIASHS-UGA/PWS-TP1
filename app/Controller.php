<?php

namespace App;

abstract class Controller
{
  protected $model_name = "";
  protected $model_name_single = "";
  protected $folder_name = "";

  function index()
  {
    $model = new $this->model_name;
    $models = $model->list();

    $view_content = new \App\View([$this->folder_name => $models], ['content' => [$this->folder_name.'/list']], 'content', false);
    $view_aside = new \App\View([], ['form' => [$this->folder_name.'/form']], 'aside', false);
    new \App\View([], ['content' => $view_content, 'aside' => $view_aside]);

  }

  function add()
  {
    if (!empty($_POST)) {
      $model = new $this->model_name;
      $model->add($_POST);
    }

    $this->index();
  }

  function edit($id)
  {
    $model = new $this->model_name;

    if (!empty($_POST)) {
      $model->update($_POST);
      return $this->index();
    }

    $model = $model->get($id);

    $view_aside = new \App\View([], ['form' => $this->folder_name.'/form'], 'aside', false);

    new \App\View([$this->model_name_single => $model], ['content' => $this->folder_name.'/edit', 'aside' => $view_aside]);
  }

  function delete($id)
  {
    $model = new $this->model_name;
    $model->delete($id);
    $this->index();
  }
}
