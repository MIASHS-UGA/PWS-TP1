<?php
namespace App\Repositories;

class ArticleSQL extends \App\RepositorySQL
{
  static $tablename = 'articles';
  static $pk_name = 'article_id';
  static $fields = ['article_title', 'article_content', 'article_date'];
  static $modelname = '\App\Models\Article';
}
